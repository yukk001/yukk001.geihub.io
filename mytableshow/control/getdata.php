<?php 
include_once("../conn/conn.php");
include_once("../class/contract.class.php");

    //���ù�������
    //file_put_contents('a.txt', var_export($_GET,true));
    $query_obj = new MyContractList();
    if($_GET["CONTRACT_NUM"]){
		$CONTRACT_NUM =  $_GET["CONTRACT_NUM"];
	}//��ͬ���
	
	if($_GET["CONTRACT_NAME"]){
		$CONTRACT_NAME =  $_GET["CONTRACT_NAME"];
	}//��ͬ����

	if($_GET["AMOUNT_MIN"]){
		$AMOUNT_MIN =  $_GET["AMOUNT_MIN"];
	}	
	if($_GET["AMOUNT_MAX"]){
		$AMOUNT_MAX =  $_GET["AMOUNT_MAX"];
	}//��ͬ���
	
	if($_GET["LEADER"]){
		$LEADER = $_GET["LEADER"];
	}//��ͬ������
	
	if($_GET["ITEM_NAME"]){
		$ITEM_NAME =  $_GET["ITEM_NAME"];
	}//��Ŀ����
	
	if($_GET["CONTRACT_TYPE"]){
		$CONTRACT_TYPE =  $_GET["CONTRACT_TYPE"];
	}//��ͬ����
	
	if($_GET["SECOND_TYPE"]){
		$SECOND_TYPE =  $_GET["SECOND_TYPE"];
	}//��������
	
	if($_GET["CONTRACT_RUNID"]){
		$CONTRACT_RUNID =  $_GET["CONTRACT_RUNID"];
	}//��ͬ������ˮ��
	
	if($_GET["DEPT_ID"]){
		$DEPT_ID =  $_GET["DEPT_ID"];
	}
	
	
	if($_GET["PARTY_A"]){
		$PARTY_A =  $_GET["PARTY_A"];
	}//�׷�
	
	if($_GET["CONTRACT_TERM"]){
		$CONTRACT_TERM =  $_GET["CONTRACT_TERM"];
	}//��ͬ����
	
	if($_GET["SIGNED_TIME"]){
		$SIGNED_TIME =  $_GET["SIGNED_TIME"];
	}//ǩ��ʱ��
	
	if($_GET["ARCHIVE_TIME"]){
		$ARCHIVE_TIME =  $_GET["ARCHIVE_TIME"];
	}//�鵵ʱ��
	
	if($_GET["IS_ITEM"]){
		$IS_ITEM =  $_GET["IS_ITEM"];
	}//�Ƿ�Ϊ��ͬ��Ŀ
	
	if($_GET["PARTY_B"]){
		$PARTY_B =  $_GET["PARTY_B"];
	}//�ҷ�
	
	if($_GET["PARTY_C"]){
		$PARTY_C =  $_GET["PARTY_C"];
	}//����
	
	if($_GET["BANK_ACCOUNT"]){
		$BANK_ACCOUNT =  $_GET["BANK_ACCOUNT"];
	}//�����˺�
	
	if($_GET["ACTUAL_PAYMENT"]){
		$ACTUAL_PAYMENT =  $_GET["ACTUAL_PAYMENT"];
	}//ʵ�ʸ���
	
	if($_GET["ACTUAL_COLLECTION"]){
		$ACTUAL_COLLECTION =  $_GET["ACTUAL_COLLECTION"];
	}//ʵ���տ�
	
	if($_GET["CONTRACT_CONTENT"]){
		$CONTRACT_CONTENT =  $_GET["CONTRACT_CONTENT"];
	}//��ͬ��Ҫ����
	
	if($_GET["COPIES"]){
		$COPIES =  $_GET["COPIES"];
	}//����
	
	if($_GET["LAST_COPIES"]){
		$LAST_COPIES = $_GET["LAST_COPIES"];
	}//ʣ�����

	if($_GET['LENDED_COPIES']){
		$LENDED_COPIES = $_GET["LENDED_COPIES"];
	}//״̬

	if($_GET["VERSION"]){
		$VERSION =  $_GET["VERSION"];
	}//�汾
	
	if($_GET["ARCHIVE_ADDRESS"]){
		$ARCHIVE_ADDRESS =  $_GET["ARCHIVE_ADDRESS"];
	}//�鵵λ��
	
	if($_GET["ITEM_NUM"]){
		$ITEM_NUM =  $_GET["ITEM_NUM"];
	}//��Ŀ���
	
	if($_GET["PAYMENT_RATIO"]){
		$PAYMENT_RATIO =  $_GET["PAYMENT_RATIO"];
	}//�������
	
	if($_GET["OPERATORS_TYPE"]){
		$OPERATORS_TYPE =  $_GET["OPERATORS_TYPE"];
	}//��Ӫ�����
	
	if($_GET["PROVINCE"]){
		$PROVINCE =  $_GET["PROVINCE"];
	}//ʡ��
	
	if($_GET["REGION"]){
		$REGION =  $_GET["REGION"];
	}//����
	
	if($_GET["ARCHIVE_LEADER"]){
		$ARCHIVE_LEADER =  $_GET["ARCHIVE_LEADER"];
	}//�鵵��
	
	if($_GET["BEGIN_TIME"]){
		$begin_time =  $_GET["BEGIN_TIME"];
	}//
	if($_GET["END_TIME"]){
		$end_time =  $_GET["END_TIME"];
	}//��ͬ��������
	
   //file_put_contents("getdata.get.txt",var_export($_GET,true));
    $arr_priv = explode(",", "1,34");
    
    if(in_array(34,$arr_priv)||in_array(1,$arr_priv))
    {
        $query_obj->_set("contract_query_type", "2");
    }
    
    if($_GET["pageType"])
    {
        $pageType = $_GET["pageType"];
    }
    
	$order_by_field = isset($_POST['sidx']) ? $_POST['sidx'] : "SIGNED_TIME";
	$order_by_direct = isset($_POST['sord']) ? $_POST['sord'] : "DESC";
	$rows		=	$_POST["rows"];
    $page		=	$_POST["page"];
    if (!$page){$page = 1;}
	if (!$rows){$rows = 10;}

	
	$query_obj->_set("contract_num", $CONTRACT_NUM);
	$query_obj->_set("contract_name", $CONTRACT_NAME);
	$query_obj->_set("amount_min", $AMOUNT_MIN);
	$query_obj->_set("amount_max", $AMOUNT_MAX);
	$query_obj->_set("leader", $LEADER);
	$query_obj->_set("item_name", $ITEM_NAME);
	$query_obj->_set("contract_type", $CONTRACT_TYPE);
	$query_obj->_set("second_type", $SECOND_TYPE);
	$query_obj->_set("contract_runid", $CONTRACT_RUNID);
	$query_obj->_set("dept_id", $DEPT_ID);
	$query_obj->_set("party_a", $PARTY_A);
	$query_obj->_set("contract_term", $CONTRACT_TERM);
	$query_obj->_set("signed_time", $SIGNED_TIME);
	$query_obj->_set("archive_time", $ARCHIVE_TIME);
	$query_obj->_set("contract_state", $IS_ITEM); // 
	$query_obj->_set("party_b", $PARTY_B);
	$query_obj->_set("party_c", $PARTY_C);
	$query_obj->_set("bank_account", $BANK_ACCOUNT);
	$query_obj->_set("actual_payment", $ACTUAL_PAYMENT);
	$query_obj->_set("actual_collection", $ACTUAL_COLLECTION);
	$query_obj->_set("contract_content", $CONTRACT_CONTENT);
	
	$query_obj->_set("copies", $COPIES);
	$query_obj->_set("last_copies", $LAST_COPIES);
	$query_obj->_set("lended_copies", $LENDED_COPIES);
	$query_obj->_set("version", $VERSION);
	$query_obj->_set("archive_address", $ARCHIVE_ADDRESS);
	$query_obj->_set("item_num", $ITEM_NUM);
	$query_obj->_set("payment_ratio", $PAYMENT_RATIO);
	
	$query_obj->_set("operators_type", $OPERATORS_TYPE);
	$query_obj->_set("province", $PROVINCE);
	$query_obj->_set("region", $REGION);
	$query_obj->_set("archive_leader", $ARCHIVE_LEADER);
	$query_obj->_set("begin_time", $begin_time);
	$query_obj->_set("end_time", $end_time);
	
	$query_obj->_set("order_by_field", $order_by_field);
	$query_obj->_set("order_by_direct", $order_by_direct);
	
    
	$query_obj->_set("start_pos", ($page-1)*$rows); 
	$query_obj->_set("row_number", $rows);
	
	$count = $query_obj->getContractListCount(); 
	$list = $query_obj->getContractList();
	
	
	foreach($list as $key => $value)
	{
		$q_contract_num		=	$value["CONTRACT_NUM"];
		$q_contract_name	=	cstr_replace("\\","\\\\",$value["CONTRACT_NAME"]);
		$q_leader			=	rtrim(GetUserNameById($value["LEADER"]),",");
		$q_signed_time		=	$value["SIGNED_TIME"];
		$q_amount		    =	number_format($value["AMOUNT"],2);
		$q_contract_runid	=	"<a href=javascript:view_work(\"\",\"".$value['CONTRACT_RUNID']."\",\"\",\"214\"); title=\"\">".$value["CONTRACT_RUNID"]."</a>";
		/*$q_last_copies      =   $value["LAST_COPIES"];*/
		$q_last_copies = "";
		if($value["COPIES"] == 0 && $value["LAST_COPIES"] == 0){
			$q_last_copies = "��ǩ��";
		}else if($value["COPIES"] != 0 && $value["LAST_COPIES"] == 0){
			$q_last_copies = "δ�黹";
		}else{
			$q_last_copies = $value["LAST_COPIES"];
		}

		//����
		$q_opation = "";
		if(in_array(34,$arr_priv)||in_array(1,$arr_priv)){
            $q_opation .= "<a href=\"javascript:void(0);\" onclick=\" window.open('contract_change.php?id=".$key."')\" title=\"�޸�\" >�޸�</a>  ";
        }
        if(in_array(1,$arr_priv)){
            $q_opation .= "  <a href=\"javascript:void(0);\" onclick=\"delete_contract('".$key."')\" title=\"ɾ��\"   >ɾ��</a>";
        }
        $LogsItem = array(
            $q_contract_num,
            $q_contract_name, 
            
            $q_amount,
            $q_leader,
            $q_contract_runid,
            $q_signed_time,
            $q_last_copies,
            $q_opation
        );
        			
        	$LogsItem[] = $ACTION;
        	$s_operation="";
        	$result["rows"][] = array("cell" => $LogsItem,"flow_id" => $q_flow_id);
	}
	$result['records'] = $count; //�ܼ�¼��
	$result['page'] = $page; //��ǰҳ
	$result['total'] = (integer)(($result['records']-1)/$rows)+1; //��ҳ��
	ob_end_clean();
	header("Cache-Control: no-cache, must-revalidate" );
	header("Pragma: no-cache" );
	header("Content-type: text/x-json; charset=$MYOA_CHARSET");
	echo array_to_json($result);
?>




?>