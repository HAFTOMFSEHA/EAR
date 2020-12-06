<?php

namespace App\Http\Repositories;

class MenuRepository
{
	public function getAdminMainMenuList()
	{
        // this is main menu list
        return [
            ['name' => 'dashboard', 'label' => '<i class="fa fa-tachometer"></i> &nbsp Dashboard'],

			['name' => 'language', 'label' => "<img alt='' src='/images/language.png' style='width:15px;border-radius: 20px;'> &nbsp Language"],

			['name' => 'genres', 'label' => '<i class="fa fa-server"></i> &nbsp Genres'],

            ['name' => 'country', 'label' => '<i class="fa fa-map-marker"></i> &nbsp Country'],

			['name' => 'radio', 'label' => '<i class="fa fa-music"></i> &nbsp Radio List'],

			['name' => 'mostly_played', 'label' => '<i class="fa fa-music"></i> &nbsp Mostly Played'],
			
			['name' => 'feedback', 'label' => "<img alt='' src='/images/feedback.png' style='width:15px;border-radius: 20px;'> &nbsp Feedback"],

			['name' => 'report', 'label' => "<img alt='' src='/images/report.png' style='width:15px;border-radius: 20px;'> &nbsp Report"],

			['name' => 'notification', 'label' => '<i class="fa fa-bell"></i> &nbsp Send Notification'],

            
        ];
	}

	public function getAdminSubMenuList()
	{
		return [
			[
				'mainMenu' 	=> 'dashboard',
				'label' 	=> 'OverView',
				'route' 	=> route('admin.dashboard'),
			],

			[
				'mainMenu' 	=> 'language',
				'label' 	=> 'Language',
				'route' 	=> route('admin.language.index'),
			],

			[
				'mainMenu' 	=> 'country',
				'label' 	=> 'Country',
				'route' 	=> route('admin.country.index'),
			],

			[
				'mainMenu' 	=> 'genres',
				'label' 	=> 'Genres',
				'route' 	=> route('admin.genres.index'),
			],

			[
				'mainMenu' 	=> 'radio',
				'label' 	=> 'Radio List',
				'route' 	=> route('admin.radio.index'),
			],

			[
				'mainMenu' 	=> 'mostly_played',
				'label' 	=> 'Mostly Played',
				'route' 	=> route('admin.mostly-played.index'),
			],

			[
				'mainMenu' 	=> 'notification',
				'label' 	=> 'Send Notification',
				'route' 	=> route('admin.notification.index'),
			],

			[
				'mainMenu' 	=> 'feedback',
				'label' 	=> 'Feedback',
				'route' 	=> route('admin.feedback.index'),
			],

			[
				'mainMenu' 	=> 'report',
				'label' 	=> 'Report',
				'route' 	=> route('admin.report.index'),
			],


			
        ];
	}
}
