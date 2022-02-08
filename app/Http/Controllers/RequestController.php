<?php

namespace App\Http\Controllers;

use App\Enum\Banks;
use App\Models\User;
use App\Payment\Payer;
use App\Models\Request;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Events\RequestRejected;
use App\Events\RequestRejectedEvent;
use App\Http\Resources\RequestResource;
use App\Http\Requests\StoreRequestRequest;
use App\Http\Requests\RejectRequestRequest;
use App\Http\Requests\UpdateRequestRequest;
use Illuminate\Http\Request as HttpRequest;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Throwable;

class RequestController extends Controller
{
    public function index()
    {
        $financialRequests = Request::with('user','category', 'media')->get();

        // dd($financialRequests);

        return \view('requests.index')->with('financialRequests', $financialRequests);
    }

    public function create()
    {
        $categories = Category::pluck('name', 'id')->toArray();

        return \view('requests.create')->with('categories', $categories);
    }

    public function store(StoreRequestRequest $request)
    {
        $financialRequest = Request::create($request->safe()->all());

        if ($request->has('file')) {
            $financialRequest->addMediaFromRequest("file")->toMediaCollection();
        }

        return $request->ajax() ?
             new RequestResource($financialRequest) :
            \redirect()->route('requests.create')->with('success', true) ;
    }

    public function download(Media $media)
    {
        return response()->download($media->getPath(), $media->file_name);
    }

    public function approve(Request $request)
    {
        $request->approve();

        return \back();
    }

    public function rejection(Request $request)
    {
        return \view('requests.rejection')->with('financialRequest', $request);
    }

    public function reject(RejectRequestRequest $httpRequest, Request $request)
    {
        $request->reject($httpRequest->reason);

        return redirect()->route('requests.index');
    }

    public function bulkApprove(HttpRequest $request)
    {
        Request::findMany(array_keys($request->get("requests")))->each(fn(Request $request) => $request->approve());

        return redirect()->route('requests.index');
    }

    public function bulkReject(HttpRequest $request)
    {
        Request::findMany(array_keys($request->get("requests")))->each(fn (Request $request) => $request->reject());

        return redirect()->route('requests.index');
    }

    public function pay(HttpRequest $httpRequest)
    {
        // If its a large dataset, it should be queued.
        (new Payer)->clear();

        return redirect()->route('requests.index');
    }
}
