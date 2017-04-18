<?php

/**
 * �۲���ģʽӦ�ó���ʵ��
 *
 *
 * ����������
 * �Թ�ƱΪ����ҵ��(��ģʽ�����ڸ�ҵ��)����Χ�ƹ�Ʊ�������ͬ�������߼����磺
 * 1����Ʊ���¼�ı���־
 * 2����Ʊ���¼���ݿ���־
 * 3����Ʊ���Ͷ���
 * 4����Ʊ�͵ֿ۾��һ�������
 * 5������������
 *
 * ��ͳ�������:
 * �ڹ�Ʊ�߼������ڲ�������ش��룬��ɸ����߼���
 *
 * �������⣺
 * 1��һ��ĳ��ҵ���߼������ı䣬�繺Ʊҵ������������ҵ���߼�����Ҫ�޸Ĺ�Ʊ�����ļ���������Ʊ���̡�
 * 2���ջ����ۺ��ļ��߳������º���ά�����ѡ�
 *
 * ��������ԭ����Ҫ�ǳ����"�������"��ʹ�ù۲�ģʽ��Ŀǰ��ҵ���߼��Ż���"�����"���ﵽ��ά�������޸ĵ�Ŀ�ģ�
 * ͬʱҲ��������ӿڱ�̵�˼�롣
 *
 * �۲���ģʽ����ʵ�ַ�ʽ��
 * 1������2���ӿڣ��۲��ߣ�֪ͨ���ӿڡ����۲��ߣ����⣩�ӿ�
 * 2������2���࣬�۲��߶���ʵ�ֹ۲��߽ӿڡ�������ʵ�ֱ����߽ӿ�
 * 3��������ע���Լ���Ҫ֪ͨ�Ĺ۲���
 * 4��������ĳ��ҵ���߼�����ʱ֪ͨ�۲��߶���ÿ���۲���ִ���Լ���ҵ���߼���
 *
 * ʾ���������´���
 *
 */
#===================����۲��ߡ����۲��߽ӿ�============
/**
 *
 * �۲��߽ӿ�(֪ͨ�ӿ�)
 *
 */
interface ITicketObserver //�۲��߽ӿ�
{
    function onBuyTicketOver($sender, $args); //�õ�֪ͨ����õķ���
}
 
/**
 *
 * ����ӿ�
 *
 */
interface ITicketObservable //���۲����ӿ�
{
    function addObserver($observer); //�ṩע��۲��߷���
}
#====================������ʵ��========================
/**
 *
 * �����ࣨ��Ʊ��
 *
 */
class PiaoBuy implements ITicketObservable { //ʵ������ӿڣ����۲��ߣ�
    private $_observers = array (); //֪ͨ���飨�۲��ߣ�
   
 
	public function buyTicket($ticket) //��Ʊ�����࣬����Ʊ����
	{
	   // TODO ��Ʊ�߼�
	   
	   //ѭ��֪ͨ��������onBuyTicketOverʵ�ֲ�ͬҵ���߼�
	   foreach ( $this->_observers as $obs )
	       $obs->onBuyTicketOver ( $this, $ticket ); //$this ��������ȡ������������֪ͨ��ʹ��
	}
   
	//���֪ͨ
	public function addObserver($observer) //���N��֪ͨ
	{
	   $this->_observers [] = $observer;
	}
	
}
 
#=========================������֪ͨ====================
//������־֪ͨ
class PiaoMSM implements ITicketObserver {
    public function onBuyTicketOver($sender, $ticket) {
       echo (date ( 'Y-m-d H:i:s' ) . " ������־��¼����Ʊ�ɹ�:$ticket\n");
    }
}

//�ʼ�֪ͨ
class PiaoEmail implements ITicketObserver {
    public function onBuyTicketOver($sender, $ticket) {
       echo (date ( 'Y-m-d H:i:s' ) . " �����ʼ�����Ʊ�ɹ�:$ticket\n");
    }
}


//�ı���־֪ͨ
class PiaoTxt implements ITicketObserver {
    public function onBuyTicketOver($sender, $ticket) {
       echo (date ( 'Y-m-d H:i:s' ) . " �ı���־��¼����Ʊ�ɹ�:$ticket\n");
    }
}

//�ֿ۾�����֪ͨ
class PiaoDiKou implements ITicketObserver {
    public function onBuyTicketOver($sender, $ticket) {
       echo (date ( 'Y-m-d H:i:s' ) . " ���͵ֿ۾���Ʊ�ɹ�:$ticket ����10Ԫ�ֿ۾�1�š�\n");
    }
}

#============================�û���Ʊ====================
$buy = new PiaoBuy ();
$buy->addObserver ( new PiaoMSM () ); //���ݲ�ͬҵ���߼��������֪ͨ
$buy->addObserver ( new PiaoTxt () );
$buy->addObserver ( new PiaoDiKou () );
$buy->addObserver ( new PiaoEmail () );
//��Ʊ
$buy->buyTicket ( "һ��һ��" );
