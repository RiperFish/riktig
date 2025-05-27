import "../css/style.css";
console.log("✅ Vite is working!");

document.querySelectorAll(".accordion-toggle").forEach((button) => {
  button.addEventListener("click", () => {
    document.querySelectorAll(".accordion-content").forEach((c) => {
      c.classList.add("max-h-0");
      c.classList.remove("max-h-[500px]");
      //previousElementSibling
      //.querySelector(".indicator").classList.remove("rotate-180");
    });

    const content = button.nextElementSibling;
    const isOpen = content.classList.contains("max-h-0");

    if (isOpen) {
      content.classList.remove("max-h-0");
      content.classList.add("max-h-[500px]");
      button.querySelector(".indicator").classList.add("rotate-180");
      //Collapse all if you want single open
    } else {
      content.classList.remove("max-h-[500px]");
      content.classList.add("max-h-0");
      button.querySelector(".indicator").classList.remove("rotate-180");
    }
  });
});

  console.log("dsfgsdg");
jQuery(document).ready(function ($) {
  const sendMovingQuote = document.querySelector("#send-moving-quote");
  let ajaxUrl = "";
  if (devMode == "staging") {
    ajaxUrl = ajaxurl;
  } else {
    ajaxUrl = my_ajax_object.ajax_url;
  }

  let emailObject = {
    clientInfos : [],
    itemsData : [],
    address : [],
    volume:[]
  }

  let clientInfos = JSON.parse(sessionStorage.getItem('clientInfos'))
  console.log(clientInfos['serviceType']);
  
  if(clientInfos['serviceType'] == "moving"){
    const selectedItems = JSON.parse(sessionStorage.getItem('itemsData'))
    let volume = "50"
    emailObject.clientInfos.push(clientInfos)
    emailObject.itemsData.push(selectedItems)
    emailObject.volume.push(volume)
  }

  console.log(emailObject);
  
  
  
  
  if (sendMovingQuote !== null) {
    sendMovingQuote.addEventListener("click", () => {
      $.ajax({
        url: ajaxUrl,
        type: "POST",
        data: {
          action: "send_moving_quote_action",
          //nonce: my_ajax_object.nonce,
          message: "Hello from JS",
        },
        success: function (response) {
          console.log("Server response:", response);
        },
      });
    });
  }
});

function sendEmail() {}
