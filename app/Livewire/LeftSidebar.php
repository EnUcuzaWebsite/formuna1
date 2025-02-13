<?php

namespace App\Livewire;

use Livewire\Component;

class LeftSidebar extends Component
{
    public $sidebar_list = [
        ["path" => "home", "icon" => "home", "title" => "Anasayfa"],
//        ["path" => "home", "icon" => "users", "title" => "Keşfet"],
        ["path" => "saved.forms", "icon" => "bookmark", "title" => "Kaydedilenler"],
        ["path" => "liked.forms", "icon" => "heart", "title" => "Beğenilenler"],
        ["path" => "categories", "icon" => "bars-3", "title" => "Kategoriler"],
//        ["path" => "home", "icon" => "users", "title" => "Üyeliklerin"],
//        ["path" => "home", "icon" => "user-plus", "title" => "Takip Edilenler"],
//        ["path" => "home", "icon" => "cog", "title" => "Ayarlar"],
    ];

    public function render()
    {
        return view('components.aside.left-sidebar', ['sidebar_list' => $this->sidebar_list]);
    }
}
