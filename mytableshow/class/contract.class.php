<?php

class MyContractList
{
    private $contract_id;//����ID
    private $dept_id;//����
    private $contract_type;//��ͬ����
    private $second_type;//��������
    private $item_num;//��Ŀ���
    private $item_name;//��Ŀ����
    private $contract_num;//��ͬ���
    private $is_item; //�Ƿ�Ϊ��Ŀ��ͬ
    private $contract_state;//��ͬ״̬
    private $signed_time;//ǩ��ʱ��
    private $archive_time;//�鵵ʱ��
    private $archive_address;//�鵵λ��
    private $contract_name;//��ͬ����   
    private $party_a;//�׷�    
    private $party_b;//�ҷ�    
    private $party_c;//����    
    private $contract_content;//��ͬ��Ҫ����
    private $amount_min;//��ͬ����ѯ����   
    private $amount;//��ͬ���   
    private $amount_max;//��ͬ����ѯ����    
    private $payment_ratio;//�������   
    private $contract_term;//��ͬ����  
    private $bank_account;//�����˺�   
    private $version;//�汾   
    private $copies;//���� 
    private $leader;//��ͬ������    
    private $archive_leader;//�鵵��    
    private $operators_type;//��Ӫ�����   
    private $province;//ʡ��   
    private $region;//���� 
    private $actual_collection;//ʵ���տ�
    private $actual_payment;//ʵ�ʸ���
    private $contract_runid;//��ͬ������ˮ��
    private $remarks;//��ע
    
    
    private $begin_time;
    private $end_time;
    
    private $contract_query_type=1;

    private $start_pos = 0;

    private $row_number = 10;
    
    private $order_by_field;

    private $order_by_direct;


    public function __construct($dept_id="",$contract_type="",$second_type="",$item_num="",$item_name="",$contract_num="",$contract_state="",$signed_time="",$archive_time="",$archive_address="",$contract_name="",$party_a="",$party_b="",$party_c="",$contract_content="",$amount="",$payment_ratio="",$contract_term="",$bank_account="",$version="",$copies="",$leader="",$archive_leader="",$operators_type="",$province="",$region="",$actual_collection="",$actual_payment="",$contract_runid="")
    {

        $this->dept_id = $dept_id;
        $this->contract_type = $contract_type;
        $this->second_type = $second_type;
        $this->item_num = $item_num;
        $this->item_name = $item_name;
        $this->contract_num = $contract_num;
        $this->contract_state = $contract_state;
        $this->signed_time = $signed_time;
        $this->archive_time = $archive_time;
        $this->archive_address = $archive_address;
        $this->contract_name = $contract_name;
        $this->party_a = $party_a;
        $this->party_b = $party_b;
        $this->party_c = $party_c;
        $this->contract_content = $contract_content;
        $this->amount = $amount;
        $this->payment_ratio = $payment_ratio;
        $this->contract_term = $contract_term;
        $this->bank_account = $bank_account;
        $this->version = $version;
        $this->copies = $copies;
        $this->leader = $leader;
        $this->archive_leader = $archive_leader;
        $this->operators_type = $operators_type;
        $this->province = $province;
        $this->region = $region;
        $this->actual_collection = $actual_collection;
        $this->actual_payment = $actual_payment;
        $this->contract_runid = $contract_runid;
        $this->order_by_field = "CONTRACT.SIGNED_TIME";
        $this->order_by_direct = "DESC";
    
    }

    public function _get($property_name)
    {

        $property_name = strtolower ( $property_name );
        
        if (isset ( $this->$property_name ))
        {
            
            return $this->$property_name;
        }
        else
        {
            
            return NULL;
        }
    
    }

    public function _set($property_name, $value)
    {

        $property_name = strtolower ( $property_name );
        
        $this->$property_name = $value;
    
    }
    
    
    public function getContractListCount($r_connection = NULL)
    {

        if ($r_connection == NULL)
        {
            $r_connection = TD::conn ();
        }
        
        $select_expr = " COUNT( CONTRACT.CONTRACT_ID) as TOTAL_NUMBER ";
        $where_definition = $this->getCondition ();
        $table_reference = " CONTRACT ";
        $sql = "SELECT " . $select_expr . " FROM " . $table_reference . $where_definition;
        
        $total_number = 0;
        $r_cursor = exequery ( $r_connection , $sql );
        if ($row = mysql_fetch_array ( $r_cursor ))
        {
            $total_number = $row ["TOTAL_NUMBER"];
        }
        
        return $total_number;
    
    }

    public function getContractList($r_connection = NULL)
    {

        if ($r_connection == NULL)
        {
            $r_connection = TD::conn ();
        }
        
        $list = Array ();
        
        $select_expr = " CONTRACT.CONTRACT_ID, 
                         CONTRACT.DEPT_ID, 
                         CONTRACT.CONTRACT_TYPE,
                         CONTRACT.SECOND_TYPE,
                         CONTRACT.ITEM_NUM,
                         CONTRACT.IS_ITEM,
                         CONTRACT.ITEM_NAME,
                         CONTRACT.CONTRACT_NUM,
                         CONTRACT.CONTRACT_COUNTER_NUM,
                         CONTRACT.CONTRACT_STATE,
                         CONTRACT.SIGNED_TIME,
                         CONTRACT.ARCHIVE_TIME,
                         CONTRACT.ARCHIVE_ADDRESS,
                         CONTRACT.CONTRACT_NAME,
                         CONTRACT.PARTY_A,
                         CONTRACT.PARTY_B,
                         CONTRACT.PARTY_C,
                         CONTRACT.CONTRACT_CONTENT, 
                         CONTRACT.AMOUNT, 
                         CONTRACT.PAYMENT_RATIO,
                         CONTRACT.CONTRACT_TERM,
                         CONTRACT.BANK_ACCOUNT,
                         CONTRACT.VERSION,
                         CONTRACT.COPIES,
                         CONTRACT.LENDED_COPIES,
                         CONTRACT.LAST_COPIES,
                         CONTRACT.LEADER,
                         CONTRACT.ARCHIVE_LEADER,
                         CONTRACT.OPERATORS_TYPE,
                         CONTRACT.PROVINCE,
                         CONTRACT.REGION,
                         CONTRACT.ACTUAL_COLLECTION,
                         CONTRACT.ACTUAL_PAYMENT,
                         CONTRACT.CONTRACT_RUNID ,
                         CONTRACT.ORIGINAL_COPY ";
                         
        $where_definition = $this->getCondition ();
        
        $order_definition = " ORDER BY " . $this->order_by_field . " " . $this->order_by_direct;
        if ($this->start_pos != 0 || $this->row_number != 0)
        {
            $limit_definition = " LIMIT " . $this->start_pos . ", " . $this->row_number;
        }
        else
        {
            $limit_definition = "";
        }
        
        $sql = "SELECT " . $select_expr . " FROM CONTRACT " . $where_definition . $order_definition . $limit_definition;
        file_put_contents("contractlist_sql.txt",var_export($sql,true));
        $r_cursor = exequery ( $r_connection , $sql );
        while ( $row = mysql_fetch_array ( $r_cursor ) )
        {
            $list [$row ["CONTRACT_ID"]] = Array (
                   
					'DEPT_ID'		=>	$row['DEPT_ID'],
					'CONTRACT_TYPE'		=>	$row['CONTRACT_TYPE'],
					'SECOND_TYPE'		=>	$row['SECOND_TYPE'],
					'ITEM_NUM'	=>	$row['ITEM_NUM'],
					'IS_ITEM'		=>	$row['IS_ITEM'],
					'ITEM_NAME'		=>	$row['ITEM_NAME'],
					'CONTRACT_NUM'		=>	$row['CONTRACT_NUM'],
					'CONTRACT_COUNTER_NUM'		=>	$row['CONTRACT_COUNTER_NUM'],
					'SIGNED_TIME'		=>	$row['SIGNED_TIME'],
					'ARCHIVE_TIME'		=>	$row['ARCHIVE_TIME'],
					'ARCHIVE_ADDRESS'		=>	$row['ARCHIVE_ADDRESS'],
					'CONTRACT_NAME'		=>	$row['CONTRACT_NAME'],
					'PARTY_A'		=>	$row['PARTY_A'],
					'PARTY_B'		=>	$row['PARTY_B'],
					'PARTY_C'		=>	$row['PARTY_C'],
					'CONTRACT_CONTENT'		=>	$row['CONTRACT_CONTENT'],
					'AMOUNT'		=>	$row['AMOUNT'],
					'PAYMENT_RATIO'		=>	$row['PAYMENT_RATIO'],
					'CONTRACT_TERM'		=>	$row['CONTRACT_TERM'],
					'BANK_ACCOUNT'		=>	$row['BANK_ACCOUNT'],
					'COPIES'		=>	$row['COPIES'],
					'LENDED_COPIES'		=>	$row['LENDED_COPIES'],	
					'LAST_COPIES'   =>	$row['LAST_COPIES'],			
					'LEADER'		=>	$row['LEADER'],
					'ARCHIVE_LEADER'		=>	$row['ARCHIVE_LEADER'],
					'OPERATORS_TYPE'		=>	$row['OPERATORS_TYPE'],
					'PROVINCE'		=>	$row['PROVINCE'],
					'REGION'		=>	$row['REGION'],
					'ACTUAL_COLLECTION'		=>	$row['ACTUAL_COLLECTION'],
					'ACTUAL_PAYMENT'		=>	$row['ACTUAL_PAYMENT'],
					'CONTRACT_RUNID'		=>	$row['CONTRACT_RUNID'],
            		'ORIGINAL_COPY'		=>	$row['ORIGINAL_COPY']
            );
        }
        
        return $list;
    
    }

    private function getCondition()
    {

        
        
        if (! empty ( $this->contract_query_type ) && $this->contract_query_type != "")
        {
            if($this->contract_query_type==2) //��ͬ����ԱȨ��Ϊ���к�ͬ
            {
                $str_condition = " WHERE CONTRACT.CONTRACT_ID !='' AND CONTRACT.DELETE_FLAG='1'  ";
                if (! empty ( $this->dept_id ) && $this->dept_id != "")//��ͬ��������
	            {
	                $str_condition .= " AND CONTRACT.DEPT_ID = '" . $this->dept_id . "' ";
	            }
            }
            else
            {
                $str_condition = " WHERE CONTRACT.CONTRACT_NUM !='' AND CONTRACT.DELETE_FLAG='1'  AND CONTRACT.DEPT_ID = '" . $this->dept_id . "' ";
            }
            
        }
        else
        {
            $str_condition = " WHERE CONTRACT.CONTRACT_NUM !='' AND CONTRACT.DELETE_FLAG='1' ";
            if (! empty ( $this->dept_id ) && $this->dept_id != "")//��ͬ��������
            {
                $str_condition .= " AND CONTRACT.DEPT_ID = '" . $this->dept_id . "' ";
            }
        }
        
        

        if (! empty ( $this->contract_num ) && $this->contract_num != "")//��ͬ���
        {
            $str_condition .= " AND CONTRACT.CONTRACT_NUM LIKE '%" . $this->contract_num . "%' ";
        }
        
        if (! empty ( $this->is_item ) && $this->is_item != "")//�Ƿ�Ϊ��Ŀ��ͬ
        {
            $str_condition .= " AND CONTRACT.IS_ITEM = '" . $this->is_item . "' ";
        }
        
        if (! empty ( $this->contract_name ) && $this->contract_name != "")//��ͬ����
        {
            
            $str_condition .= " AND CONTRACT.CONTRACT_NAME LIKE '%" . $this->contract_name . "%' ";
        }
        
        if (! empty ( $this->contract_type ) && $this->contract_type != "")//��ͬ����
        {
            
            $str_condition .= " AND CONTRACT.CONTRACT_TYPE = '" . $this->contract_type . "' ";
        }
        
        if (! empty ( $this->second_type ) && $this->second_type != "")//��ͬ��������
        {
            $str_condition .= " AND CONTRACT.SECOND_TYPE = '" . $this->second_type . "' ";
        }
        
        if (! empty ( $this->item_num ) && $this->item_num != "")//��ͬ��Ŀ���
        {
            $str_condition .= " AND CONTRACT.ITEM_NUM = '" . $this->item_num . "' ";
        }     
        
        if (! empty ( $this->item_name ) && $this->item_name != "")//��ͬ��Ŀ����
        {
            $str_condition .= " AND CONTRACT.ITEM_NAME LIKE '%" . $this->item_name . "%' ";
        }     
        
        if (! empty ( $this->contract_state ) && $this->contract_state != "")//��ͬ״̬
        {
            $str_condition .= " AND CONTRACT.CONTRACT_STATE = '" . $this->contract_state . "' ";
        }     
        
        
        if (! empty ( $this->begin_time ) && trim ( $this->begin_time ) != "")
        {
            if (! empty ( $this->end_time ) && trim ( $this->end_time ) != "")
            {
                $str_condition .= " AND (CONTRACT.SIGNED_TIME BETWEEN '" . $this->begin_time . " 00:00:00' AND '" . $this->end_time . " 23:59:59') ";
            }
            else
            {
                $str_condition .= " AND CONTRACT.SIGNED_TIME >= '" . $this->begin_time . " 00:00:00' ";
            }
        }
        else
        {
            if (! empty ( $this->end_time ) && $this->end_time != NULL && trim ( $this->end_time ) != "")
            {
                $str_condition .= " AND CONTRACT.SIGNED_TIME <= '" . $this->end_time . " 23:59:59' ";
            }
        } 
          
        if (! empty ( $this->signed_time ) && $this->signed_time != "")//��ͬǩ��ʱ��
        {
            
            $str_condition .= " AND CONTRACT.SIGNED_TIME = '" . $this->signed_time . "' ";
            
        } 
        
        
        
            
        
        if (! empty ( $this->archive_time ) && $this->archive_time != "")//��ͬ�鵵ʱ��
        {
            $str_condition .= " AND CONTRACT.ARCHIVE_TIME = '" . $this->archive_time . "' ";
        }     
        
        if (! empty ( $this->archive_address ) && $this->archive_address != "")//��ͬ�鵵λ��
        {
            $str_condition .= " AND CONTRACT.ARCHIVE_ADDRESS = '" . $this->archive_address . "' ";
        }            
        
         if (! empty ( $this->party_a ) && $this->party_a != "")//��ͬ�׷�
        {
            $str_condition .= " AND CONTRACT.PARTY_A LIKE '%" . $this->party_a . "%' ";
        }  
        
         if (! empty ( $this->party_b ) && $this->party_b != "")//��ͬ�ҷ�
        {
            $str_condition .= " AND CONTRACT.PARTY_B LIKE '%" . $this->party_b . "%' ";
        }  
        
         if (! empty ( $this->party_c ) && $this->party_c != "")//��ͬ����
        {
            $str_condition .= " AND CONTRACT.PARTY_C LIKE '%" . $this->party_c . "%' ";
        }  
        
        if (! empty ( $this->contract_content ) && $this->contract_content != "")//��ͬ��Ҫ����
        {
            $str_condition .= " AND CONTRACT.CONTRACT_CONTENT LIKE '%" . $this->contract_content . "%' ";
        }  
        
        
        
        if (! empty ( $this->amount ) && $this->amount != "")//��ͬ���
        {
            $str_condition .= " AND CONTRACT.AMOUNT = '" . $this->amount . "' ";
        }  
         if (! empty ( $this->amount_min ) && trim ( $this->amount_min ) != "")
        {
            if (! empty ( $this->amount_max ) && trim ( $this->amount_max ) != "")
            {
                $str_condition .= " AND (CONTRACT.AMOUNT BETWEEN  ". $this->amount_min ."  AND  ". $this->amount_max .") ";
            }
            else
            {
                $str_condition .= " AND CONTRACT.AMOUNT >= ". $this->amount_min ." ";
            }
        }
        else
        {
            if (! empty ( $this->amount_max ) && $this->amount_max != NULL && trim ( $this->amount_max ) != "")
            {
                $str_condition .= " AND CONTRACT.AMOUNT <= ". $this->amount_max ." ";
            }
        } 
        
        
        if (! empty ( $this->payment_ratio ) && $this->payment_ratio != "")//��ͬ�������
        {
            $str_condition .= " AND CONTRACT.PAYMENT_RATIO = '" . $this->payment_ratio . "' ";
        } 
        
        if (! empty ( $this->contract_term ) && $this->contract_term != "")//��ͬ����
        {
            $str_condition .= " AND CONTRACT.CONTRACT_TERM = '" . $this->contract_term . "' ";
        }  
        
        if (! empty ( $this->bank_account ) && $this->bank_account != "")//�����˺�
        {
            $str_condition .= " AND CONTRACT.BANK_ACCOUNT LIKE '%" . $this->bank_account . "%' ";
        }  
        
        if (! empty ( $this->version ) && $this->version != "")//��ͬ�汾
        {
            $str_condition .= " AND CONTRACT.VERSION = '" . $this->version . "' ";
        }  
        
        if (! empty ( $this->copies ) && $this->copies != "")//��ͬ����
        {
            $str_condition .= " AND CONTRACT.COPIES = '" . $this->copies . "' ";
        }
        
        if (! empty ( $this->leader ) && $this->leader != "")//��ͬ������
        {
            $str_condition .= " AND CONTRACT.LEADER = '" . $this->leader . "' ";
        }
        
        if (! empty ( $this->archive_leader ) && $this->archive_leader != "")//��ͬ�鵵��
        {
            $str_condition .= " AND CONTRACT.ARCHIVE_LEADER = '" . $this->archive_leader . "' ";
        }
        
        if (! empty ( $this->operators_type ) && $this->operators_type != "")//��ͬ��Ӫ�����
        {
            $str_condition .= " AND CONTRACT.OPERATORS_TYPE = '" . $this->operators_type . "' ";
        }
        
        if (! empty ( $this->province ) && $this->province != "")//��ͬʡ��
        {
            $str_condition .= " AND CONTRACT.PROVINCE = '" . $this->province . "' ";
        }
        
        if (! empty ( $this->region ) && $this->region != "")//��ͬ����
        {
            $str_condition .= " AND CONTRACT.REGION = '" . $this->region . "' ";
        }
        
        if (! empty ( $this->actual_collection ) && $this->actual_collection != "")//��ͬʵ���տ�
        {
            $str_condition .= " AND CONTRACT.ACTUAL_COLLECTION = '" . $this->actual_collection . "' ";
        }
        if (! empty ( $this->actual_payment ) && $this->actual_payment != "")//��ͬʵ�ʸ���
        {
            $str_condition .= " AND CONTRACT.ACTUAL_PAYMENT = '" . $this->actual_payment . "' ";
        }
        if (! empty ( $this->contract_runid ) && $this->contract_runid != "")//��ͬ������ˮ��
        {
            $str_condition .= " AND CONTRACT.CONTRACT_RUNID = '" . $this->contract_runid . "' ";
        }
        //file_put_contents("a.txt",var_export($str_condition,true));
        return $str_condition;
    
    }





}



?>
