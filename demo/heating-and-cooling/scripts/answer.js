function saveMeta(module,answer) {
	var submitURL = "../../save-meta.php";
	var dataString = "moduleid="+ module + "&answer=" + answer;  
	$.ajax({  
	  type: "POST",  
	  url: submitURL, 
	  data: dataString, 
	  async: false,
	  error: function(xhr,err) {  
		alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
		alert("responseText: "+xhr.statusText);
	  }
	});
}

function saveAnswer(question,answer) {
	var submitURL = "../../save-answer.php";
	var dataString = "question="+ question + "&answer=" + answer;  
	$.ajax({  
	  type: "POST",  
	  url: submitURL, 
	  data: dataString, 
	  //async: false,
	  error: function(xhr,err) {  
		alert("readyState: "+xhr.readyState+"\nstatus: "+xhr.status);
		console.log("responseText: "+xhr.responseText);
	  },
	});
}