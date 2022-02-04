<?php
namespace App\Helpers;

use App\Model\RfqItem;
use App\Model\Country;
use App\Model\Supplier;
use App\Model\State;
use App\Model\RfqStatus;
use App\Model\PriceSetup;
use App\Model\RfqItemDoc;
use App\Model\SupplierQuotesOnRfqItem;
use Illuminate\Support\Facades\Auth;
use App\User;
class CommonHelper {
    
   /*  public static function getAnswer($ans_id)
    {
        $ans = ChapterQuestionOption::where('id', $ans_id)->first();
        $answer = !empty($ans->title) ? $ans->title : '';
        return $answer;
    } */
    public static function getQuotevalue($rfq_items,$rfq_item_send_id)
    {
        $QuoteDetail = SupplierQuotesOnRfqItem::where('rfq_item_send_id', $rfq_item_send_id)->where('rfq_items', $rfq_items)->first();
        $quotes = !empty($QuoteDetail->quotes) ? $QuoteDetail->quotes : '';
        return $quotes;
    }
    public static function getQuoteStatus($rfq_items,$rfq_item_send_id)
    {
        $QuoteDetail = SupplierQuotesOnRfqItem::where('rfq_item_send_id', $rfq_item_send_id)->where('rfq_items', $rfq_items)->first();
        $quotes = $QuoteDetail->status;
        return $quotes;
    }
	 public static function getQuotevaluedeatails($rfq_items,$rfq_item_send_id)
    {
        $QuoteDetail = SupplierQuotesOnRfqItem::where('rfq_item_send_id', $rfq_item_send_id)->where('rfq_items', $rfq_items)->first();
        $quotes = !empty($QuoteDetail) ? $QuoteDetail : array();
        return $quotes;
    }
    public static function getQuoteDetails($rfq_items,$rfq_item_send_id)
    {
        $QuoteDetail = SupplierQuotesOnRfqItem::where('rfq_item_send_id', $rfq_item_send_id)->where('rfq_items', $rfq_items)->first();
        $quotes = !empty($QuoteDetail->quotes) ? $QuoteDetail->quotes : '';
        return $QuoteDetail;
    }

    public static function getItemDetails($item_id)
    {
        $data = RfqItem::join('rfqs','rfqs.id','=','rfq_items.rfq_id')->join('items','items.id','=','rfq_items.item_id')->join('unit_measures','unit_measures.id','=','rfq_items.unit')->join('product_groups','product_groups.id','=','rfq_items.product_group')->where('rfq_items.id',$item_id)
	      ->select('rfq_items.*','rfqs.rfq_id','items.item_number','unit_measures.code','product_groups.group_code')
	      ->get();

        return $data;
    }
	
	public static function getCountryName($country_id=null){
			$country = Country::where('id', $country_id)->first();
			$country = !empty($country->name) ? $country->name : '';
			return $country;
	}
	public static function getStateName($state_id=null){
			$country = State::where('id', $state_id)->first();
			$country = !empty($country->name) ? $country->name : '';
			return $country;
	}
	public static function getRfqStatusTitle($id=null){
			$country = RfqStatus::where('id', $id)->first();
			$country = !empty($country->name) ? $country->name : '';
			return $country;
	}

	public static function getUserDetails($user_id=null){
			$user = User::where('id', $user_id)->first();
			
			return $user;
	}
	public static function getSupplierDetails($user_id=null){
			$user = Supplier::where('id', $user_id)->first();
			
			return $user;
	}
	public static function getRfqItemDoc($item_id=null){
			$user = RfqItemDoc::where('rfq_items_id', $item_id)->get();
			
			return $user;
	}
	
	
	public static function getSubscriptionDetails($subscribe_id=null){
			$user = PriceSetup::where('id',$subscribe_id)->first();
			
			return $user;
	}
	
}
