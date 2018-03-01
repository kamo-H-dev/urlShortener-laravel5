<?php

namespace App\Http\Controllers;

use App\UrlItem;

class RedirectLongUrlController extends Controller
{
    /**
     * Redirecting to the original link by short url.
     *
     * @param  string $short_url
     * @return mixed
     */
    public function index($short_url)
    {
        if (strlen($short_url) != ((int)env('SHORT_URL_LENGTH', 6) + 2)) { //this par comes from this example: d-yjQ66R
            return 'Invalid short code. Please fix it.';
        }

        $short_url = env('BASE_URL', 'http://localhost:8000') . '/' . $short_url;
        $item = UrlItem::getByShortUrl($short_url);

        if (!empty($item)) {
            $item->redirects += 1;
            if ($item->save()) {
                $fullUrl = preg_match('/^(http|https)/', $item->long_url);
                if (!$fullUrl) {
                    return redirect('http://' . $item->long_url);
                } else {
                    return redirect($item->long_url);
                }
            }
        } else {
            return 'Invalid short code. Please fix it.';
        }
    }
}