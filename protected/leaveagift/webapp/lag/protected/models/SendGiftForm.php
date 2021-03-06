<?php

/* SendGiftForm form model is used for send gift form */

class SendGiftForm extends CFormModel
{

 	public $delivery;
        public $wall_post_message;
        public $friends_email;
        public $notification_email;

        public $pid;/* the sending product's id */
 

      
	/**
	 * Declares the validation rules.
	 * title is required
	 */
	public function rules()
	{
		return array(
			array('delivery', 'required'),
			array('delivery','checkDate'),
                       // array('delivery','type','type'=>'date','format'=>'MM/dd/yyyy'),
                       // array('delivery','date','format'=>'MM/dd/yyyy'), 
                        array('friends_email,notification_email,pid,wall_post_message,delivery','safe'),  
                        array('friends_email,notification_email','email'),
		       );
	}
        public function checkDate($attribute,$params)
        {
           /*$date= explod('/',$this->delivery);
            echo "ok";
            print_r($date);*/
            $date= explode('/',$this->delivery);
            //echo $date;
            // print_r($date);
             
             
             if(!isset($date[0])||!isset($date[1])||!isset($date[2]))
              {
                $this->addError($attribute, 'Invalid date.');
              }
              
              if(strlen($date[0])!=3||strlen($date[1])!=2||strlen($date[2])!=4)
               {
                   //echo "c1:".strlen($date[0]);
                   //echo "c2:".strlen($date[1]);
                   //echo "c3:".strlen($date[2]);
                 $this->addError($attribute, 'Invalid date.The right format is(M/dd/yyyy)');
               }
             
             if(!checkdate(date("m",strtotime($date[2]."-".$date[0]."-".$date[1])) ,$date[1] , $date[2] )) 
              {
                $this->addError($attribute, 'Invalid date.The right format is(M/dd/yyyy)'); 
              
              }
             
             
           //  echo "okkk".$this->delivery;
           // exit;
           //$this->addError($attribute, 'Invalid date');
        }
	
	/**
	 * Declares attribute labels.
	 */
	public function attributeLabels()
	{
		return array(
			'delivery'=>'Delivery(M/dd/yyyy)',
                        'wall_post_message'=>'Edit wall post message',
                        'friends_email'=>'You can also deliver by email (recommended)',
                        'notification_email'=>'3. How should we notify you of delivery?',
               
		);
	}
        public function getDeliveryOptions()
        {
          return array(
                      'today'=>'Today',
                      'tomorrow'=>'Tomorrow',
                     );
        }
 
}

?>
