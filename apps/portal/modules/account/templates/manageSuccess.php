<?php use_helper('Date') ?>
<?php use_helper('Number') ?>

<div id="account_management" class="container_full">
    
    <div class="header_wrapper clearfix">
    	<div class="fl">
       		<h2>Manage Account</h2>
        </div>
        <div class="fr">
        	<div class="content_tab_wrapper clearfix">
            	<ul>
                	<li class="selected"><a href="/account/manage">Account Information</a></li>
                    <li><a href="/account/viewBilling">Billing Information</a></li>
                </ul>
			</div>
        </div>
    </div>
    
    <div class="clearfix">
        <div class="fl balloon span-20">
            <div class="view_data block_content">
               
               <h3>Account Details</h3>	
               <div class="fr" style="padding: 5px 0 0 0;">
               	Member Since <?= format_datetime(strtotime($account->getCreated())) ?>
               </div>
               
               <ul style="border: none;clear:left;">

               <li>
                 <div class="view_data clearfix">
                    <div class="fl label">
                        Current Plan
                    </div>
                    <div class="fl data">
                         <?= ucFirst(strtolower($account->getPlan()->getType())) ?>,  <?= format_currency($account->getPlan()->getPrice(), 'USD') ?> / month
                    </div>
                    <div class="fl">
							

                            <a href="#">Upgrade / Downgrade Plan</a>
                            <br/>
                            <a href="#">Cancel Account</a>
                       
                    </div>
                </div>
               </li>
               <li>
                <div class="view_data clearfix">
                    <div class="fl label">
                        Account URL
                    </div>
                    <div class="fl data">
                         http://<?= $account->getName() . '.' . $account->getDomain()->getName()?>
                    </div>
                    <div class="fl">
                         <a href="#">Change URL</a> 
                    </div>
                </div>
               </li>
               
               
               <li>
                <div class="view_data clearfix">
                    <div class="fl label">
                        Account Owner
                    </div>
                    <div class="fl data">
                         <form>
                         
                         	
                         	<select>
                         		 <? foreach ($account->getAccountUserRole() as $aUser): ?>
                					<option value="<?= $aUser->getUser()->getId()?>" <?= $aUser->getRoleId() == sfConfig::get('app_account-role_owner')?"selected":"" ?>><?= $aUser->getUser()->getProfile()->getFirstName() ?> <?= $aUser->getUser()->getProfile()->getLastName() ?> </option>
                			 	 <? endforeach; ?>
                         	</select>
                            <div class="hint_notes">
                            	The account owner is the only person who can
                                view this page, upgrade / downgrade, view billing information,
                                and cancel this account.
                            </div>
                    </div>
                    <div class="fl">
                         <input type="submit" value="Change Owner" />
                         </form>
                    </div>
                </div>
               </li>
               <li>
                <div class="view_data clearfix">
                    <div class="fl label">
                        Export Data
                    </div>
                    <div class="fl data">
                         <form>
                         	<select>
                            	<option>All</option>
                                <option>Kodazi</option>
                                <option>Harmonix</option>
                                <option>MacGuyver</option>
                                <option>Biogen</option>
                            </select>
                         
                    </div>
                    <div class="fl">
                         <input type="submit" value="Export Data" />
                         </form>
                    </div>
                </div>
               </li>
               </ul>
               
               
               <?
               	//print_r ($accountUserRole);
               ?>
                
                <br/>
                
            </div>
        </div>
        
        


</div>

