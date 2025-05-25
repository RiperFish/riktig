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


jQuery(document).ready(function ($) {
  const sendForm = document.querySelector("#set-addresses");

  if (sendForm !== null) {
    sendForm.addEventListener("click", () => {
      const items = document.querySelectorAll(".item");
      let data = {};

      items.forEach((item) => {
        const id = item.dataset.id;
        const volume = parseFloat(item.dataset.volume);
        const qty = parseInt(item.querySelector(".qty").textContent);
        if (qty > 0) {
          data[id] = {
            quantity: qty,
            volumePerItem: volume,
            totalVolume: Math.round(qty * volume * 100) / 100,
          };
        }
      });
      console.log(data);
      // Store in sessionStorage (client-side)
      sessionStorage.setItem("itemsData", JSON.stringify(data));
      const stepperStep2 = document.querySelector('#stepper-step2')
      const stepperStep3 = document.querySelector('#stepper-step3')

      stepperStep2.classList.remove('active')
      stepperStep2.classList.add('finished')

      stepperStep3.classList.add('active')
      stepperStep3.classList.remove('next')

      $.ajax({
        url: ajaxurl,
        type: "POST",
        data: {
          action: "my_ajax_action",
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
