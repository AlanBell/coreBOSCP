<?php
/*
 * Chive - web based MySQL database management
 * Copyright (C) 2010 Fusonic GmbH
 *
 * This file is part of Chive.
 *
 * Chive is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public
 * License as published by the Free Software Foundation; either
 * version 3 of the License, or (at your option) any later version.
 *
 * Chive is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU
 * General Public License for more details.
 *
 * You should have received a copy of the GNU General Public
 * License along with this library. If not, see <http://www.gnu.org/licenses/>.
 */
class Controller extends CController
{

	protected $request;

	/**
	 * @see		CController::filters()
	 */
	public function filters()
	{
		return array(
			'accessControl',
		);
	}

	/**
	 * @see		CController::accessRules()
	 */
	public function accessRules()
	{
		return array(
			array('deny',
				'users' => array('?'),
			),
		);
	}

	/**
	 * @see CController::createUrl()
	 */
	public function createUrl($route, $params = array(), $ampersand = '&')
	{
		if(!empty($route) and $route{0} == '#')
		{
			if(($query = Yii::app()->getUrlManager()->createPathInfo($params, '=', $ampersand)) !== '')
			{
				return $route . '?' . $query;
			}
			else
			{
				return $route;
			}
		}
		else
		{
			return parent::createUrl($route, $params, $ampersand);
		}
	}

}
