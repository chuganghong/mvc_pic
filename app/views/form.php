<?php
class form
{
	protected $action;      //处理表单请求的url
	protected $method;      //发送数据的方式
	protected $submitValue;      //submit上显示的文字
	protected $other;       //其他的，比如enctype="multipart/form-data"
	protected $content;     //表单内容
	
	function __construct($action,$method,$submitValue,$other="",$content)
	{
		$this->action = $action;
		$this->method = $method;
		$this->submitValue = $submitValue;
		$this->other = $other;
		$this->content = $content;
		$this->show_form();
	}
	
	//输出表单
	function show_form()
	{
		echo "<form action=\"" . $this->action . "\" method=\"" . $this->method . "\" " . $this->other . ">";
		if( is_array($this->content) )
		{
			foreach( $this->content as $value )
			{
				$this->show($value);
			}			
		}
		else
		{
			$this->show($this->content);
			
		}
		echo "<input type=\"submit\" value=\"" . $this->submitValue . "\" />";
		echo "</from>";
	}
	
	//检测是否是对象，然后输出
	function show($variable)
	{
		if( is_object($variable) )
		{
			$variable->display();    //接口
		}
		else
		{
			$variable;
		}
	}
}