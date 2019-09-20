
function downloadresume(url, cand_id, account_id, job_id, obj){    
  data = {"candidate_profile_id" : cand_id, "candidate_account_id" : account_id, "download_source":"job_applicant", "job_post_id": job_id};  
    $.ajax({url: url, type: 'POST', data: data,success: function(result){
      if(result == 'true'){
          $(obj).find('div').text('Resume Downloaded');              
          $(obj).contents().unwrap();
      }    
      else
          document.write(result); 

  }});   
}

function confirmAction(delUrl, msg) {
  if (confirm("Are you sure you want to "+ msg +"?")) {
    document.location = delUrl;
  }
}
