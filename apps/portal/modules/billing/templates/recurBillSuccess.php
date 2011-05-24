<script>
  $(document).ready(function(){
    $("#paymentForm").validate();
  });
  </script>


<div id="sub_contents">
       <h2>Make payment:</h2>
      <div id="sub_col_one">
      <b class="xtop_gray"><b class="xb1_gray"></b><b class="xb2_gray"></b><b class="xb3_gray"></b><b class="xb4_gray"></b></b>
        <div class="xboxcontent_gray"> 
        <div class="box_nobg">
            <?php echo form_tag('@pay', 'id=paymentForm method=post') ?>
        
            <div class="div_textfield">
                <label for="amount">Amount:</label>
                <input type="radio" name="amount" id="amount" class="required" value="10"/> $24.99
                <input type="radio" name="amount" id="amount" class="required" value="10"/> $49.99
                <input type="radio" name="amount" id="amount" class="required" value="10"/> $74.99
            </div>
      
      
      <div class="div_textfield">
      <label for="cardholder_name">Cardholder Name:</label>
        <input type="text" name="cardholder_name" id="cardholder_name" class="textfield required" />
      </div>
      
      <div class="div_textfield">
      <label for="card_number">Card Number:</label>
        <input type="text" name="card_number" id="card_number" class="textfield required"/>
      </div>
      <div class="div_textfield">
      <label for="card_number">CVV Code:</label>
      <input type="text" name="ccv" id="ccv" class="textfield_date"/>
      </div>
      <div class="div_textfield">
      <label for="card_exp">Expiration Date:</label>
        <select name="exp_month" class="textfield_date required">
                <option value="">Mo</option>
                <option value="01">01</option>
                <option value="02">02</option>
                <option value="03">03</option>
                <option value="04">04</option>
                <option value="05">05</option>
                <option value="06">06</option>
                <option value="07">07</option>
                <option value="08">08</option>
                <option value="09">09</option>
                <option value="10">10</option>
                <option value="11">11</option>
                <option value="12">12</option>
       </select> 
               <select name="exp_year" class="textfield_date">
                <option value="">Year</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
                <option value="2011">2011</option>
                <option value="2012">2012</option>
                <option value="2013">2013</option>
                <option value="2014">2014</option>
                <option value="2015">2015</option>
                <option value="2016">2016</option>
                <option value="2017">2017</option>
                <option value="2018">2018</option>
                <option value="2019">2019</option>
                <option value="2020">2020</option>
       </select>

      </div>
      
      
      
            <div class="div_textfield">
                <label for="p_number">&nbsp;</label>
                <input name="submit" type="submit" value="Submit" class="generic_button" />
            </div>
            </form>
         </div>
        </div>
      </div>
</div>
