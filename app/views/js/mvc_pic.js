function $(id)
{
	return document.getElementById(id);
}

function choseReceiver(value,value_id)     //在通讯录点击联系人后，此联系人出现在收件人地址栏
{
	//if( document.getElementById("receiver").value == "" )
	//{
		document.getElementById("receiver").value = value;
		choseReceiverId(value_id);
	//}
	/*暂时只实现一次只能给一个用户发私信
	else
	{
		var value_1 = value;
		var value_2 = document.getElementById("receiver").value.split(",");
		if( value_2.indexOf(value_1)==-1 )
		{
			value_2.push(value_1);
			document.getElementById("receiver").value = value_2.toString();
			choseReceiverId(value_id);
		}
	}
	*/
}

function choseReceiverId(value)     //在通讯录点击联系人后，此联系人ID出现在隐藏的收件人ID，与choseReceiver(value,value_id)一起使用
{
	//if( document.getElementById("receiverId").value == "" )
	//{
		document.getElementById("receiverId").value = value;
	//}
	/*暂时只实现一次只能给一个用户发私信
	else
	{
		var value_1 = value;
		var value_2 = document.getElementById("receiverId").value.split(",");
		if( value_2.indexOf(value_1)==-1 )
		{
			value_2.push(value_1);
			document.getElementById("receiverId").value = value_2.toString();
		}
	}
	*暂时只实现一次只能给一个用户发私信*/
}

//选中与反选
function check()
{
	var boxes = document.getElementsByTagName("input");
	for(var i=0;i<boxes.length;i++)
	{
		if( boxes[i].type == "checkbox" )
		{
			boxes[i].checked = true;
		}
	}
}
function uncheck()
{
	var boxes = document.getElementsByTagName("input");
	for(var i=0;i<boxes.length;i++)
	{
		if( boxes[i].type == "checkbox" )
		{
			if(boxes[i].checked == true)
			{
				boxes[i].checked = false;
			}
			else
			{
				boxes[i].checked = true;
			}
		}
	}
}

function goToPage()
{
	var x = document.getElementById("mySelect");
	location.href = x.options[x.selectedIndex].value;
}