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
                	<li><a href="/account/manage">Account Information</a></li>
                    <li class="selected"><a href="/account/viewBilling">Billing Information</a></li>
                </ul>
			</div>
        </div>
    </div>
    
    <div class="clearfix">
        <div class="fl balloon span-20">
            <div class="view_data block_content clearfix">
               
              

                <? if (sizeof($account->getPaymentTransaction()) > 0): ?>
                
                 <h3>Plan Information</h3>
               
               <ul style="border: none;clear:left;">
               <li>
                
                <table class="data_table no_border">
               		<tr>
                    	<th style='width: 258px;'>Billing Info</th>
                        <td>
                        	<?= $account->getRecentPaymentTransaction()->getPaymentCard()->getCardNum() ?>
                            <div class="hint_notes">
                            	(Next billing period <?= format_datetime(strtotime($account->getRecentPaymentTransaction()->getCreated()."+1 month")) ?>)
                            </div>
                        
                        </d>
                        <td class="right"><a href="#">Change Payment Method</a></td>
                    </tr>
                </table>
               </li>
               
               </ul>

               <br/>
               
               <h3>Billing History</h3>
               <div style="clear:both;">
               <table class="data_table">
               		<tr>
                    	<th>Date</th>
                        <th>Charged To</th>
                        <th class="right">Amount</th>
                    </tr>
                    
                    <? foreach ($account->getPaymentTransaction() as $payment): ?>
                    <tr>
                    	<td><?= format_datetime(strtotime($payment->getCreated())) ?></td>
                        <td><?= $payment->getPaymentCard()->getCardNum() ?></td>
                        <td class="right"><?= format_currency($payment->getTotalValue()) ?></td>
                    </tr>
                    <? endforeach; ?>
               
               </table>
               </div>
               <? else: ?>
               
               
                <h3>No Billing History</h3>
                
                <p class="clear">
                	The first payment cycle will be billed, and appear in this history on [date]
                    
                </p>
               
               
               <? endif; ?>
                
            </div>
        </div>
        
        


</div>