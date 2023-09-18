var resultContainer = document.getElementById("qr-reader-results");
var lastResult,
    countResults = 0;

// function onScanSuccess(decodedText, decodedResult) {
//   if (decodedText !== lastResult) {
//     ++countResults;
//     lastResult = decodedText;
//     // Handle on success condition with the decoded message.

//     var member_id = decodedResult;
//     $.ajax({
//       type: "ajax",
//       method: "post",
//       url: "save",
//       data: {
//         id: member_id,
//       },
//       async: false,
//       dataType: "text",
//       success: function (response) {
//         var data = response;
//         // console.log(data.account_details[0].name);
//         alert(`Successful time in: ${data.account_details[0].name}`);
//       },
//       error: function () {
//         alert("Something went wrong");
//       },
//     });
//   }
// }

function onScanSuccess(decodedText, decodedResult) {
    if (decodedText !== lastResult) {
        ++countResults;
        lastResult = decodedText;

        var member_id = decodedText;
        $.ajax({
            type: "ajax",
            method: "post",
            url: "attendance/log",
            data: {
                member_id: member_id,
            },
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            async: false,
            dataType: "text",
            success: function (response) {
                var data = JSON.parse(response);
                console.log(data);

                // Append the attendance to the list
                var attendanceList = document.getElementById("attendance-list");
                var li = document.createElement("li");
                li.innerHTML =
                    "<span>" +
                    data.member.last_name +
                    "</span>" +
                    "<span>" +
                    data.attendance.attended_at +
                    "</span>";
                attendanceList.appendChild(li);

                alert(
                    `Successful time in: ${data.member.first_name} ${data.member.last_name}`
                );
            },
            error: function (e) {
                alert("Something went wrong");
            },
        });
    }
}

var html5QrcodeScanner = new Html5QrcodeScanner("qr-reader", {
    fps: 10,
    qrbox: 250,
    formatsToSupport: ["QR_CODE"],
    // Add the following code for UI enhancements
    cssAnimations: {
        scanLine: {
            // Customize the scan line animation
            name: "scanLine",
            duration: 2000,
            timing: "linear",
        },
    },
    createCanvasElement: true,
    // End of UI enhancements
});

html5QrcodeScanner.render(onScanSuccess);
