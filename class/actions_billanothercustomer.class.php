<?php
/* <one line to give the program's name and a brief idea of what it does.>
 * Copyright (C) 2015 ATM Consulting <support@atm-consulting.fr>
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * \file    class/actions_mymodule.class.php
 * \ingroup mymodule
 * \brief   This file is an example hook overload class file
 *          Put some comments here
 */

/**
 * Class ActionsBillAnotherCustomer
 */
class ActionsBillAnotherCustomer
{
	/**
	 * @var array Hook results. Propagated to $hookmanager->resArray for later reuse
	 */
	public $results = array();

	/**
	 * @var string String displayed by executeHook() immediately after return
	 */
	public $resprints;

	/**
	 * @var array Errors
	 */
	public $errors = array();

	/**
	 * Constructor
	 */
	public function __construct()
	{
	}

	function formObjectOptions($parameters, &$object, &$action, $hookmanager)
	{
		if(!empty($parameters['objectsrc'])) {
			global $db, $conf, $langs;
			
			$langs->load('billanothercustomer@billanothercustomer');
			$form = new Form($db);
			
			$parentId = $parameters['objectsrc']->thirdparty->id;
			if($conf->global->BILLANOTHERCUSTOMER_USE_PARENT_BY_DEFAULT && !empty($parameters['objectsrc']->thirdparty->parent))
			{
				$parentId = $parameters['objectsrc']->thirdparty->parent;
			}
			
			print '<tr>';
			print '<td class="fieldrequired">'.$langs->trans('CustomerToBill').'</td>';
			print '<td colspan="2">'.$form->select_company($parentId, 'socid', 's.client = 1 OR s.client = 3').'</td>';
			print '</tr>';
		}
	}
}