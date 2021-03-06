<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
//require 'vendor/autoload.php';

class CalendarController extends Controller {
	protected $f3;
	protected $calendar;
	public function __construct() {
		$this->f3 = Base::instance();
		$this->calendar= new \Calendar();
	}


	public function index() {
		$notscheduled= $this->calendar->get_notScheduled();
        $event_categories= $this->calendar->get_event_categories();


//		echo "<pre>";
//		print_r($notscheduled);

		$this->f3->set('notscheduled',$notscheduled);
        $this->f3->set('event_categories',$event_categories);

//        echo "<pre>";
//        print_r($notscheduled);

//		$this->f3->set('scheduled',$scheduled);
        echo \Template::instance()->render('calendar.htm');
	}

	public function show_appointement()
	{
		$scheduled= $this->calendar->get_Scheduled();

		$events = array();
		foreach($scheduled as $value) {
			$fullname=$value['LASTNAME'];
			$title=$value['TITLE'];
			$email=$value['EMAIL'];
			$mobile=$value['MOBPHONE'];
			$city=$value['CITY'];
			$details=$value['DETAILS'];

			$e=array();
			$e['id']=$value['idAPPOINTMENT'];
			$e['title']=$value['LASTNAME'];
			$e['appontment_object']=$value['TITLE'];
			$e['description']="<p>Appointment object: $title</p><p>Details: $details</p><p>Email: $email</p>
<p>Mobile Phone : $mobile</p><p>City: $city</p>";
			$e['start']=$value['START_APPOINTMENT'];
			$e['end']=$value['END_APPOINTMENT'];
			$e['approved']=$value['isCONFIRMED'];
			$e['color']=$value['COLOR'];

			// Merge the event array into the return array
			array_push($events,$e);
		}
		// Output json for our calendar
		echo json_encode($events);
	}

	public function add_appointment(){
        $title=$this->f3->get('POST.title');
        $details=$this->f3->get('POST.details');
        $category_temp=explode('-',$this->f3->get('POST.category'));
        $category_id=$category_temp[0];
        $name_product="Service1";
        $name_product_category="Categori1";
        $first_name=$this->f3->get('POST.first_name');
        $last_name=$this->f3->get('POST.last_name');
        $email=$this->f3->get('POST.email');
        $phone=$this->f3->get('POST.phone');
        $city="city1";
        $zip_code="1234";
        $date_appointment="dfdfd";
        $is_confirmed=0;
        $isScheduled=0;
        $disable=0;
        $id_user=1;
        $idEntity=1;
        $result=$this->calendar->addAppoint($title,$details,$category_id,$name_product,$name_product_category,$first_name,$last_name,$email,
            $phone,$city,$zip_code,$date_appointment,$is_confirmed,$isScheduled,$disable);
        echo $result;
    }

    public function add_slot(){
	    $idAPPOINTMENT=$this->f3->get('POST.idAPPOINTMENT');
        $duration=$this->f3->get('POST.duration');
        $start=$this->f3->get('POST.start');
        $result=$this->calendar->addSlot($idAPPOINTMENT, $duration, $start);
        $this->sendEventEmail($result);
        echo $result;
    }

    public function update_slot(){
        $idAPPOINTMENT=$this->f3->get('POST.idAPPOINTMENT');
        $duration=$this->f3->get('POST.duration');
        $start=$this->f3->get('POST.editStarts');
        $end=$this->f3->get('POST.editEnds');
        $idSlot=$this->f3->get('POST.idSlot');
        $result=$this->calendar->updateSlot($duration,$start,$end,$idSlot);
        echo $result;

    }

    public function fetch_slot(){
	    $result=$this->calendar->fetch_slot();
	    $slots=Array();
	    foreach ($result as $item){
	        $temp=Array();
	        $temp['title']=$item['TITLE'];
	        $temp['start']=$item['START_DATE'];
	        $temp['appointment_duration']=$item['DURATION'];
	        $temp['idAPPOINTMENT']=$item['idAPPOINTMENT'];
	        $temp['idSlot']=$item['idSLOT_APPOINTMENT'];
	        $temp['backgroundColor']=$item['COLOR'];
	        $temp['end']=$item['END_DATE'];
            $temp['stick']=true;
            $temp['editable']=true;
	        $slots[]=$temp;
        }
	    echo(json_encode($slots));
    }

    public function sendEventEmail($idSlot){
        $host = "smtp.gmail.com";
        $port=465;
        $scheme="SSL";
        $user="baimaoli9@gmail.com";
        $pw="PaekKumSong";
        $smtp = new SMTP( $host, $port, $scheme, $user, $pw );

        $event=$this->calendar->getAppointment($idSlot);

        for ($i=0;$i<count($event);$i++){
            $start_date=$event[$i]['START_DATE'];
            $event[$i]['START_DATE']=(new \DateTime($event[$i]['START_DATE']))->format('d M H:i');
            if (!is_null($item['END_DATE']))
                $event[$i]['END_DATE']=(new \DateTime($event[$i]['END_DATE']))->format('d M H:i');
            else{
                $event[$i]['END_DATE']=(new \DateTime($start_date))->format('d M')." 23:59";
            }
        }
        $this->f3->set('event',$event);
        print_r($event);
//        $smtp->set('To', '<kds1991918@gmail.com>');
        $smtp->set('To', "<$event[0][EMAIL]>");
        $smtp->set('Subject', 'Multipart test');

        $hash=uniqid(NULL,TRUE);
        $smtp->set('From', 'info@dev2.1oyo1.com');
        //$smtp->set('To', ' '.$firstname.' '.' <'.$email.'>');

        $smtp->set('Content-Type', 'multipart/alternative; boundary="'.$hash.'"');
        $smtp->set('Subject', 'Multipart test');

        $message = 'it works';

        $eol="\r\n";
        $body  = '--'.$hash.$eol;
        $body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
        $body .= '--'.$hash.$eol;
        $body .= 'Content-Type: text/html; charset=UTF-8'.$eol.$eol;
        $html=\Template::instance()->render('layouts/email.htm');
        $body .= $html.$eol;

        $smtp->send($body,true);

    }

    public function acceptAppointment(){
        $idAPPOINTMENT = $this->f3->get('PARAMS.idAPPOINTMENT');
        $this->calendar->acceptAppointment($idAPPOINTMENT);
    }

    public function acceptSlot(){
        $idSlot = $this->f3->get('PARAMS.idSlot');
        $this->calendar->acceptSlot($idSlot);
    }






	public function delete_item()
	{
		$itemId=$this->f3->get('POST.id');
		if($this->calendar->delete_item($itemId))
		{
			echo json_encode("success");
		}
		else
		{
			echo json_encode("faild");
		}
	}

	public function updateAppointment()
	{
		$event_id=$this->f3->get('POST.id');
		$event_start=$this->f3->get('POST.start');
		$new_dateformat=date('Y-m-d H:i:s',strtotime($event_start));
		if($this->calendar->update_schedule($event_id,$new_dateformat))
		{
			echo json_encode("success");
		}
		else
		{
			echo json_encode("faild");
		}
		//echo json_encode($event_data);
	}

	public function delete_event()
	{
		$event_id=$this->f3->get('POST.id');
		if($this->calendar->delete_event($event_id))
		{
			echo json_encode("success");
		}
		else
		{
			echo json_encode("faild");
		}
	}

	public function approve_event()
	{
		$event_id=$this->f3->get('POST.id');
		$event_start=$this->f3->get('POST.start');
		$new_dateformat=date('Y-m-d H:i:s',strtotime($event_start));

		if($this->calendar->approve_event($event_id,$new_dateformat))
		{
			$single_event= $this->calendar->get_event($event_id);
			$email=trim($single_event[0]['EMAIL']);
			$firstname=$single_event[0]['FIRSTNAME'];
			$event_title=$single_event[0]['TITLE'];
			$event_start=$single_event[0]['START_APPOINTMENT'];
			$event_details=$single_event[0]['DETAILS'];

			$host="smtp.free.fr";
			$port="587";
			$scheme="TLS";
			$user="jamorp.pro";
			$pw="Success000";

			$smtp = new \SMTP ( $host, $port, $scheme, $user, $pw );
			$hash=uniqid(NULL,TRUE);
			$smtp->set('From', 'info@dev2.1oyo1.com');
			//$smtp->set('To', ' '.$firstname.' '.' <'.$email.'>');
			$smtp->set('To', ' '.$firstname.' '.' <'.$email.'>, "Jamil" <jamorp.pro@gmail.com>');
			$smtp->set('Content-Type', 'multipart/alternative; boundary="'.$hash.'"');
			$smtp->set('Subject', 'Multipart test');

			$html='<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional //EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
                <html xmlns="http://www.w3.org/1999/xhtml" xmlns:o="urn:schemas-microsoft-com:office:office" xmlns:v="urn:schemas-microsoft-com:vml">
                <head>
                <!--[if gte mso 9]><xml><o:OfficeDocumentSettings><o:AllowPNG/><o:PixelsPerInch>96</o:PixelsPerInch></o:OfficeDocumentSettings></xml><![endif]-->
                <meta content="text/html; charset=utf-8" http-equiv="Content-Type"/>
                <meta content="width=device-width" name="viewport"/>
                <!--[if !mso]><!-->
                <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
                <!--<![endif]-->
                <title></title>
                <!--[if !mso]><!-->
                <link href="https://fonts.googleapis.com/css?family=Bitter" rel="stylesheet" type="text/css"/>
                <link href="https://fonts.googleapis.com/css?family=Open+Sans" rel="stylesheet" type="text/css"/>
                <!--<![endif]-->
                <style type="text/css">
                        body {
                            margin: 0;
                            padding: 0;
                        }
                
                        table,
                        td,
                        tr {
                            vertical-align: top;
                            border-collapse: collapse;
                        }
                
                        * {
                            line-height: inherit;
                        }
                
                        a[x-apple-data-detectors=true] {
                            color: inherit !important;
                            text-decoration: none !important;
                        }
                
                        .ie-browser table {
                            table-layout: fixed;
                        }
                
                        [owa] .img-container div,
                        [owa] .img-container button {
                            display: block !important;
                        }
                
                        [owa] .fullwidth button {
                            width: 100% !important;
                        }
                
                        [owa] .block-grid .col {
                            display: table-cell;
                            float: none !important;
                            vertical-align: top;
                        }
                
                        .ie-browser .block-grid,
                        .ie-browser .num12,
                        [owa] .num12,
                        [owa] .block-grid {
                            width: 605px !important;
                        }
                
                        .ie-browser .mixed-two-up .num4,
                        [owa] .mixed-two-up .num4 {
                            width: 200px !important;
                        }
                
                        .ie-browser .mixed-two-up .num8,
                        [owa] .mixed-two-up .num8 {
                            width: 400px !important;
                        }
                
                        .ie-browser .block-grid.two-up .col,
                        [owa] .block-grid.two-up .col {
                            width: 300px !important;
                        }
                
                        .ie-browser .block-grid.three-up .col,
                        [owa] .block-grid.three-up .col {
                            width: 300px !important;
                        }
                
                        .ie-browser .block-grid.four-up .col [owa] .block-grid.four-up .col {
                            width: 150px !important;
                        }
                
                        .ie-browser .block-grid.five-up .col [owa] .block-grid.five-up .col {
                            width: 121px !important;
                        }
                
                        .ie-browser .block-grid.six-up .col,
                        [owa] .block-grid.six-up .col {
                            width: 100px !important;
                        }
                
                        .ie-browser .block-grid.seven-up .col,
                        [owa] .block-grid.seven-up .col {
                            width: 86px !important;
                        }
                
                        .ie-browser .block-grid.eight-up .col,
                        [owa] .block-grid.eight-up .col {
                            width: 75px !important;
                        }
                
                        .ie-browser .block-grid.nine-up .col,
                        [owa] .block-grid.nine-up .col {
                            width: 67px !important;
                        }
                
                        .ie-browser .block-grid.ten-up .col,
                        [owa] .block-grid.ten-up .col {
                            width: 60px !important;
                        }
                
                        .ie-browser .block-grid.eleven-up .col,
                        [owa] .block-grid.eleven-up .col {
                            width: 54px !important;
                        }
                
                        .ie-browser .block-grid.twelve-up .col,
                        [owa] .block-grid.twelve-up .col {
                            width: 50px !important;
                        }
                    </style>
                         <style id="media-query" type="text/css">
                        @media only screen and (min-width: 625px) {
                            .block-grid {
                                width: 605px !important;
                            }
                
                            .block-grid .col {
                                vertical-align: top;
                            }
                
                            .block-grid .col.num12 {
                                width: 605px !important;
                            }
                
                            .block-grid.mixed-two-up .col.num3 {
                                width: 150px !important;
                            }
                
                            .block-grid.mixed-two-up .col.num4 {
                                width: 200px !important;
                            }
                
                            .block-grid.mixed-two-up .col.num8 {
                                width: 400px !important;
                            }
                
                            .block-grid.mixed-two-up .col.num9 {
                                width: 450px !important;
                            }
                
                            .block-grid.two-up .col {
                                width: 302px !important;
                            }
                
                            .block-grid.three-up .col {
                                width: 201px !important;
                            }
                
                            .block-grid.four-up .col {
                                width: 151px !important;
                            }
                
                            .block-grid.five-up .col {
                                width: 121px !important;
                            }
                
                            .block-grid.six-up .col {
                                width: 100px !important;
                            }
                
                            .block-grid.seven-up .col {
                                width: 86px !important;
                            }
                
                            .block-grid.eight-up .col {
                                width: 75px !important;
                            }
                
                            .block-grid.nine-up .col {
                                width: 67px !important;
                            }
                
                            .block-grid.ten-up .col {
                                width: 60px !important;
                            }
                
                            .block-grid.eleven-up .col {
                                width: 55px !important;
                            }
                
                            .block-grid.twelve-up .col {
                                width: 50px !important;
                            }
                        }
                
                        @media (max-width: 625px) {
                
                            .block-grid,
                            .col {
                                min-width: 320px !important;
                                max-width: 100% !important;
                                display: block !important;
                            }
                
                            .block-grid {
                                width: 100% !important;
                            }
                
                            .col {
                                width: 100% !important;
                            }
                
                            .col>div {
                                margin: 0 auto;
                            }
                
                            img.fullwidth,
                            img.fullwidthOnMobile {
                                max-width: 100% !important;
                            }
                
                            .no-stack .col {
                                min-width: 0 !important;
                                display: table-cell !important;
                            }
                
                            .no-stack.two-up .col {
                                width: 50% !important;
                            }
                
                            .no-stack .col.num4 {
                                width: 33% !important;
                            }
                
                            .no-stack .col.num8 {
                                width: 66% !important;
                            }
                
                            .no-stack .col.num4 {
                                width: 33% !important;
                            }
                
                            .no-stack .col.num3 {
                                width: 25% !important;
                            }
                
                            .no-stack .col.num6 {
                                width: 50% !important;
                            }
                
                            .no-stack .col.num9 {
                                width: 75% !important;
                            }
                
                            .video-block {
                                max-width: none !important;
                            }
                
                            .mobile_hide {
                                min-height: 0px;
                                max-height: 0px;
                                max-width: 0px;
                                display: none;
                                overflow: hidden;
                                font-size: 0px;
                            }
                
                            .desktop_hide {
                                display: block !important;
                                max-height: none !important;
                            }
                        }
                    </style>
                </head>
                <body class="clean-body" style="margin: 0; padding: 0; -webkit-text-size-adjust: 100%; background-color: #FFFFFF;">
                <style id="media-query-bodytag" type="text/css">
                @media (max-width: 625px) {
                  .block-grid {
                    min-width: 320px!important;
                    max-width: 100%!important;
                    width: 100%!important;
                    display: block!important;
                  }
                  .col {
                    min-width: 320px!important;
                    max-width: 100%!important;
                    width: 100%!important;
                    display: block!important;
                  }
                  .col > div {
                    margin: 0 auto;
                  }
                  img.fullwidth {
                    max-width: 100%!important;
                    height: auto!important;
                  }
                  img.fullwidthOnMobile {
                    max-width: 100%!important;
                    height: auto!important;
                  }
                  .no-stack .col {
                    min-width: 0!important;
                    display: table-cell!important;
                  }
                  .no-stack.two-up .col {
                    width: 50%!important;
                  }
                  .no-stack.mixed-two-up .col.num4 {
                    width: 33%!important;
                  }
                  .no-stack.mixed-two-up .col.num8 {
                    width: 66%!important;
                  }
                  .no-stack.three-up .col.num4 {
                    width: 33%!important
                  }
                  .no-stack.four-up .col.num3 {
                    width: 25%!important
                  }
                }
                </style>
                <!--[if IE]><div class="ie-browser"><![endif]-->
                <table bgcolor="#FFFFFF" cellpadding="0" cellspacing="0" class="nl-container" role="presentation" style="table-layout: fixed; vertical-align: top; min-width: 320px; Margin: 0 auto; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; background-color: #FFFFFF; width: 100%;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top; border-collapse: collapse;" valign="top">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td align="center" style="background-color:#FFFFFF"><![endif]-->
                <div style="background-color:#49a6e8;">
                <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 605px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#49a6e8;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:605px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                <!--[if (mso)|(IE)]><td align="center" width="605" style="background-color:transparent;width:605px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;"><![endif]-->
                <div class="col num12" style="min-width: 320px; max-width: 605px; display: table-cell; vertical-align: top;;">
                <div style="width:100% !important;">
                <!--[if (!mso)&(!IE)]><!-->
                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                <!--<![endif]-->
                <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 20px; padding-bottom: 20px; padding-left: 20px; border-collapse: collapse;" valign="top">
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]--><a href="http://example.com" target="_blank"> </a>
                <!--[if mso]></td></tr></table><![endif]-->
                </div>
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 20px; padding-bottom: 30px; font-family: Georgia, \'Times New Roman\', serif"><![endif]-->
                <div style="color:#FFFFFF;font-family:\'Bitter\', Georgia, Times, \'Times New Roman\', serif;line-height:120%;padding-top:20px;padding-right:10px;padding-bottom:30px;padding-left:10px;">
                <div style="font-size: 12px; line-height: 14px; font-family: \'Bitter\', Georgia, Times, \'Times New Roman\', serif; color: #FFFFFF;">
                <p style="font-size: 14px; line-height: 33px; text-align: center; margin: 0;"><span style="font-size: 28px;">Calendar app</span></p>
                </div>
                </div>
                
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                </div>
                </div>
                </div>
                <div style="background-color:#f3f3f3;">
                <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 605px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3f3f3;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:605px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                <!--[if (mso)|(IE)]><td align="center" width="605" style="background-color:transparent;width:605px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:0px; padding-bottom:0px;background-color:#FFFFFF;"><![endif]-->
                <div class="col num12" style="min-width: 320px; max-width: 605px; display: table-cell; vertical-align: top;;">
                <div style="background-color:#FFFFFF;width:100% !important;">
                <!--[if (!mso)&(!IE)]><!-->
                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:0px; padding-bottom:0px; padding-right: 0px; padding-left: 0px;">
                <!--<![endif]-->
                
                <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 5px; padding-right: 5px; padding-bottom: 5px; padding-left: 5px; border-collapse: collapse;" valign="top">
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 30px; padding-bottom: 5px; font-family: Georgia, \'Times New Roman\', serif"><![endif]-->
                <div style="color:#134C75;font-family:\'Bitter\', Georgia, Times, \'Times New Roman\', serif;line-height:120%;padding-top:30px;padding-right:30px;padding-bottom:5px;padding-left:30px;">
                <div style="font-size: 12px; line-height: 14px; font-family: \'Bitter\', Georgia, Times, \'Times New Roman\', serif; color: #134C75;">
                <p style="font-size: 14px; line-height: 28px; text-align: center; margin: 0;"><span style="font-size: 24px;"><strong> meeting</strong></span></p>
                </div>
                </div>
                <!--[if mso]></td></tr></table><![endif]-->
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 30px; padding-left: 30px; padding-top: 5px; padding-bottom: 20px; font-family: Arial, sans-serif"><![endif]-->
                <div style="color:#7E7E7E;font-family:\'Open Sans\', Helvetica, Arial, sans-serif;line-height:150%;padding-top:5px;padding-right:30px;padding-bottom:20px;padding-left:30px;">
                <div style="font-size: 12px; line-height: 18px; color: #7E7E7E; font-family: \'Open Sans\', Helvetica, Arial, sans-serif;">
                <p style="font-size: 14px; line-height: 21px; text-align: center; margin: 0;"><b>Bonjour,</b><p>Jamel Hillali (jamel.hillali@gmail.com) vous invite à participer au sondage '.$event_title.'</p>
                <a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #55acee; border-radius: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; width: auto; width: auto; border-top: 1px solid #49a6e8; border-right: 1px solid #49a6e8; border-bottom: 1px solid #49a6e8; border-left: 1px solid #49a6e8; padding-top: 2px; padding-bottom: 2px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:10px;padding-right:10px;font-size:12px;display:inline-block;"><span style="font-size: 13px; line-height: 22px;"><span data-mce-style="font-size: 12px;" style="font-size: 12px; line-height: 20px;">18APR 2:30 - 3:00</span></span></span></a>
                <a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #55acee; border-radius: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; width: auto; width: auto; border-top: 1px solid #49a6e8; border-right: 1px solid #49a6e8; border-bottom: 1px solid #49a6e8; border-left: 1px solid #49a6e8; padding-top: 2px; padding-bottom: 2px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:10px;padding-right:10px;font-size:12px;display:inline-block;"><span style="font-size: 13px; line-height: 22px;"><span data-mce-style="font-size: 12px;" style="font-size: 12px; line-height: 20px;">17APR 3:00 - 4:00</span></span></span></a>
                <a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #55acee; border-radius: 2px; -webkit-border-radius: 15px; -moz-border-radius: 15px; width: auto; width: auto; border-top: 1px solid #49a6e8; border-right: 1px solid #49a6e8; border-bottom: 1px solid #49a6e8; border-left: 1px solid #49a6e8; padding-top: 2px; padding-bottom: 2px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:10px;padding-right:10px;font-size:12px;display:inline-block;"><span style="font-size: 13px; line-height: 22px;"><span data-mce-style="font-size: 12px;" style="font-size: 12px; line-height: 20px;">19APR 5:00 - 6:00</span></span></span></a>
                <p>Event details: '.$event_details.'</p><p>Event date : '.$event_start.'</p></p>
                </div>
                </div>
                <!--[if mso]></td></tr></table><![endif]-->
                <div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="border-spacing: 0; border-collapse: collapse; mso-table-lspace:0pt; mso-table-rspace:0pt;"><tr><td style="padding-top: 10px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px" align="center"><v:roundrect xmlns:v="urn:schemas-microsoft-com:vml" xmlns:w="urn:schemas-microsoft-com:office:word" href="http://example.com" style="height:31.5pt; width:121.5pt; v-text-anchor:middle;" arcsize="58%" stroke="false" fillcolor="#49a6e8"><w:anchorlock/><v:textbox inset="0,0,0,0"><center style="color:#ffffff; font-family:Arial, sans-serif; font-size:14px"><![endif]--><a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #55acee; border-radius: 24px; -webkit-border-radius: 24px; -moz-border-radius: 24px; width: auto; width: auto; border-top: 1px solid #49a6e8; border-right: 1px solid #49a6e8; border-bottom: 1px solid #49a6e8; border-left: 1px solid #49a6e8; padding-top: 5px; padding-bottom: 5px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:25px;padding-right:25px;font-size:14px;display:inline-block;"><span style="font-size: 16px; line-height: 32px;"><span data-mce-style="font-size: 14px;" style="font-size: 14px; line-height: 28px;">Accept invitiation</span></span></span></a>
                <!--[if mso]></center></v:textbox></v:roundrect></td></tr></table><![endif]-->
                </div>
                <table border="0" cellpadding="0" cellspacing="0" class="divider" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td class="divider_inner" style="word-break: break-word; vertical-align: top; min-width: 100%; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; padding-top: 20px; padding-right: 10px; padding-bottom: 10px; padding-left: 10px; border-collapse: collapse;" valign="top">
                <div align="center" class="button-container" style="padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                <a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #aeb4b8; border: none; width: auto; width: auto;  padding-top: 5px; padding-bottom: 5px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:25px;padding-right:25px;font-size:14px;display:inline-block;"><span style="font-size: 16px; line-height: 32px;"><span data-mce-style="font-size: 14px;" style="font-size: 14px; line-height: 28px;">Report AS A Spam</span></span></span></a>
                <a href="#" style="-webkit-text-size-adjust: none; text-decoration: none; display: inline-block; color: #ffffff; background-color: #aeb4b8; border: none;width: auto; width: auto; padding-top: 5px; padding-bottom: 5px; font-family: \'Open Sans\', Helvetica, Arial, sans-serif; text-align: center; mso-border-alt: none; word-break: keep-all;" target="_blank"><span style="padding-left:25px;padding-right:25px;font-size:14px;display:inline-block;"><span style="font-size: 16px; line-height: 32px;"><span data-mce-style="font-size: 14px;" style="font-size: 14px; line-height: 28px;">Unsubscribe</span></span></span></a>
                <p  style="font-size: 14px; line-height: 21px; text-align: center; margin: 0; color:grey; width: 100%;" >Vous avez reçu cet email car vous êtes invité à chosir une date pour la demande de service effectuée sur la plateforme eCity</p>
                </div>
                <table align="center" border="0" cellpadding="0" cellspacing="0" class="divider_content" role="presentation" style="table-layout: fixed; vertical-align: top; border-spacing: 0; border-collapse: collapse; mso-table-lspace: 0pt; mso-table-rspace: 0pt; width: 100%; border-top: 0px solid transparent;" valign="top" width="100%">
                <tbody>
                <tr style="vertical-align: top;" valign="top">
                <td style="word-break: break-word; vertical-align: top; -ms-text-size-adjust: 100%; -webkit-text-size-adjust: 100%; border-collapse: collapse;" valign="top"><span></span></td>
                </tr>
                </tbody>
                </table>
                </td>
                </tr>
                </tbody>
                </table>
                <div align="center" class="img-container center autowidth" style="padding-right: 0px;padding-left: 0px;">
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr style="line-height:0px"><td style="padding-right: 0px;padding-left: 0px;" align="center"><![endif]-->
                <!--[if mso]></td></tr></table><![endif]-->
                </div>
                <!--[if (!mso)&(!IE)]><!-->
                </div>
                <!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                </div>
                </div>
                </div>
                <div style="background-color:#f3f3f3;">
                <div class="block-grid" style="Margin: 0 auto; min-width: 320px; max-width: 605px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:#f3f3f3;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:605px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                <!--[if (mso)|(IE)]><td align="center" width="605" style="background-color:transparent;width:605px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:5px; padding-bottom:5px;"><![endif]-->
                <div class="col num12" style="min-width: 320px; max-width: 605px; display: table-cell; vertical-align: top;;">
                <div style="width:100% !important;">
                <!--[if (!mso)&(!IE)]><!-->
                
                <!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                </div>
                </div>
                </div>
                <div style="background-color:transparent;">
                <div class="block-grid mixed-two-up" style="Margin: 0 auto; min-width: 320px; max-width: 605px; overflow-wrap: break-word; word-wrap: break-word; word-break: break-word; background-color: transparent;;">
                
                <p  style="font-size: 14px; line-height: 21px; text-align: center; margin: 0; color:#fff; width: 100%;" >eCity, 5 Place Léon Meyer - 76600 LE HAVRE</p>
                
                <div style="border-collapse: collapse;display: table;width: 100%;background-color:transparent;">
                
                <!--[if (mso)|(IE)]><table width="100%" cellpadding="0" cellspacing="0" border="0" style="background-color:transparent;"><tr><td align="center"><table cellpadding="0" cellspacing="0" border="0" style="width:605px"><tr class="layout-full-width" style="background-color:transparent"><![endif]-->
                <!--[if (mso)|(IE)]><td align="center" width="403" style="background-color:transparent;width:403px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 0px; padding-left: 0px; padding-top:15px; padding-bottom:15px;"><![endif]-->
                <div class="col num8" style="display: table-cell; vertical-align: top; min-width: 320px; max-width: 400px;;">
                <div style="width:100% !important;">
                
                <!--[if (!mso)&(!IE)]><!-->
                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 0px; padding-left: 0px;">
                <!--<![endif]-->
                <!--[if mso]><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top: 10px; padding-bottom: 10px; font-family: Arial, sans-serif"><![endif]-->
                <div style="color:#8F8F8F;font-family:\'Open Sans\', Helvetica, Arial, sans-serif;line-height:120%;padding-top:10px;padding-right:10px;padding-bottom:10px;padding-left:10px;">
                <div style="font-size: 12px; line-height: 14px; color: #8F8F8F; font-family: \'Open Sans\', Helvetica, Arial, sans-serif;">
                
                </div>
                </div>
                <!--[if mso]></td></tr></table><![endif]-->
                <!--[if (!mso)&(!IE)]><!-->
                </div>
                <!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td><td align="center" width="201" style="background-color:transparent;width:201px; border-top: 0px solid transparent; border-left: 0px solid transparent; border-bottom: 0px solid transparent; border-right: 0px solid transparent;" valign="top"><table width="100%" cellpadding="0" cellspacing="0" border="0"><tr><td style="padding-right: 10px; padding-left: 10px; padding-top:15px; padding-bottom:15px;"><![endif]-->
                <div class="col num4" style="display: table-cell; vertical-align: top; max-width: 320px; min-width: 200px;;">
                <div style="width:100% !important;">
                <!--[if (!mso)&(!IE)]><!-->
                <div style="border-top:0px solid transparent; border-left:0px solid transparent; border-bottom:0px solid transparent; border-right:0px solid transparent; padding-top:15px; padding-bottom:15px; padding-right: 10px; padding-left: 10px;">
                <!--<![endif]-->
                
                <!--[if (!mso)&(!IE)]><!-->
                </div>
                <!--<![endif]-->
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                <!--[if (mso)|(IE)]></td></tr></table></td></tr></table><![endif]-->
                </div>
                </div>
                </div>
                <!--[if (mso)|(IE)]></td></tr></table><![endif]-->
                </td>
                </tr>
                </tbody>
                </table>
                <!--[if (IE)]></div><![endif]-->
                </body>
                </html>';

			/*$html="<b>Bonjour,</b><p>Jamel Hillali (jamel.hillali@gmail.com) vous invite à participer au sondage ".$event_title."</p>
<p>Event details: ".$event_details."</p><p>Event date : ".$event_start."</p>";*/
			$eol="\r\n";
			$body  = '--'.$hash.$eol;
			$body .= 'Content-Type: text/plain; charset=UTF-8'.$eol;
			$body .= '--'.$hash.$eol;
			$body .= 'Content-Type: text/html; charset=UTF-8'.$eol.$eol;
			$body .= $html.$eol;

			$smtp->send($body,true);
			//echo $mylog = $smtp->log();
			echo json_encode("success");
		}
		else
		{
			echo json_encode("faild");
		}
	}

	public function update_confirmation()
	{
		$event_id=$this->f3->get('POST.id');
		$event_start=$this->f3->get('POST.start');
		$new_dateformat=date('Y-m-d H:i:s',strtotime($event_start));
		$single_event= $this->calendar->get_event($event_id);

		if($this->calendar->update_confirmation($event_id,$new_dateformat))
		{
			echo json_encode("success");
		}
		else
		{
			echo json_encode("faild");
		}
	}

}