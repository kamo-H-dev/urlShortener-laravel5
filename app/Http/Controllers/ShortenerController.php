<?php

namespace App\Http\Controllers;

use App\UrlItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;


class ShortenerController extends Controller
{
    /**
     * Get all url lists.
     *
     * @return mixed
     */
    public function index()
    {
        return UrlItem::all();
    }

    /**
     * Get the url item for the given id.
     *
     * @param  int $id
     * @return mixed
     */
    public function show($id)
    {
        return response()->json(UrlItem::find($id), 200);
    }

    /**
     * Store the url item.
     *
     * @param  Request $request
     * @return mixed
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'long_url' => 'required|string',
            'device_type' => 'string',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }
        $deviceType = $request->device_type;
        switch ($request->device_type) {
            case 'desktop';
                $shortUrlPrefix = 'd-';
                break;
            case 'mobile';
                $shortUrlPrefix = 'm-';
                break;
            case 'tablet';
                $shortUrlPrefix = 't-';
                break;
            default:
                $deviceType = 'desktop';
                $shortUrlPrefix = 'd-';
        }

        $data = [
            'long_url' => $request->long_url,
            'short_url' => env('BASE_URL', 'http://localhost:8000') . '/' . $shortUrlPrefix . UrlItem::quickRandom(env('SHORT_URL_LENGTH', 6)),
            'device_type' => $deviceType
        ];

        $urlItem = UrlItem::create($data);

        return response()->json($urlItem, 201);
    }

    /**
     * Update the url item by given id.
     *
     * @param  Request $request
     * @param  int $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $urlItem = UrlItem::find($id);
        if (!empty($urlItem)) {
            $validator = Validator::make($request->all(), [
                'long_url' => 'string',
                'short_url' => 'string',
                'device_type' => 'string',
                'redirects' => 'integer'
            ]);

            if ($validator->fails()) {
                return response()->json($validator->errors(), 400);
            }

            $data = [];
            if (!empty($request->long_url)) {
                $data['long_url'] = $request->long_url;
            }
            if (!empty($request->short_url)) {
                $data['short_url'] = $request->short_url;
            }
            if (!empty($request->device_type)) {
                $data['device_type'] = $request->device_type;
            }
            if (!empty($request->redirects)) {
                $data['redirects'] = $request->redirects;
            }
            if (!empty($data)) {
                $urlItem->update($data);
                return response()->json($urlItem, 200);
            } else {
                return response()->json(['status' => false, 'message' => 'No any changes'], 400);
            }
        } else {
            return response()->json(['status' => false, 'message' => 'Invalid Id'], 400);
        }
    }

    /**
     * Delete the url item by given id.
     *
     * @param  int $id
     * @return mixed
     */
    public function delete($id)
    {
        $response['status'] = false;
        $response['error'] = '';

        $item = UrlItem::find($id);
        if (!empty($item)) {
            $item->delete();
            $statusCode = 200;
            $response['status'] = true;
        } else {
            $statusCode = 400;
            $response['error'] = 'Invalid id for deleting item';
        }

        return response()->json($response, $statusCode);
    }
}