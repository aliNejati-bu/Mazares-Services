<?php

namespace PTC\App\Controller\Link;

use PTC\App\Model\Click;
use PTC\App\Model\Slug;
use PTC\Classes\Redirect;
use PTC\Classes\ViewEngine;

class OpenLinkController
{
    /**
     * @param $slug
     * @return Redirect|ViewEngine|string
     */
    public function getIndex($slug): Redirect|ViewEngine|string
    {
        $slug = Slug::query()->where("slug", $slug)->first();
        if (!$slug) {
            return view("err>404");
        }
        $links = $slug->links;
        if (count($links) == 0){
            return "link Error";
        }
        if (count($links) == 1){
            Click::query()->create([
                "clicker_ip" => request()->ip(),
                "slug_id" => $slug->id,
                "link_id" => $links[0]->id,
                "user_id" => $slug->user->id,
                "refer" => $_SERVER["HTTP_REFERER"] ?? "native"
            ]);
            return \redirect($links[0]->target_link);
        }
        $lastClick = $slug->clicks()->where("clicker_ip",request()->ip())->where("created_at",">=",getStartDay())->orderBy("created_at","DESC")->first();

        $nextAvailableLink = $slug->links()->where("order",">",$lastClick->link->order)->first();
        if (!$nextAvailableLink){
            Click::query()->create([
                "clicker_ip" => request()->ip(),
                "slug_id" => $slug->id,
                "link_id" => $links[0]->id,
                "user_id" => $slug->user->id,
                "refer" => $_SERVER["HTTP_REFERER"] ?? "native"
            ]);
            return \redirect($links[0]->target_link);
        }
        Click::query()->create([
            "clicker_ip" => request()->ip(),
            "slug_id" => $slug->id,
            "link_id" => $nextAvailableLink->id,
            "user_id" => $slug->user->id,
            "refer" => $_SERVER["HTTP_REFERER"] ?? "native"
        ]);
        return \redirect($nextAvailableLink->target_link);
    }
}

// TODO: ایجاد محدودیت های حساب های کاربری