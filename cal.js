const daysContainer = document.querySelector(".days");
const nextBtn = document.querySelector(".next");
const prevBtn = document.querySelector(".prev");
const todayBtn = document.querySelector(".today");
const month = document.querySelector(".month");
let modal = document.querySelector(".custom-modal");
let choice = document.querySelector(".choice");
let issueModal = document.querySelector(".issue-modal");
let overlay = document.querySelector(".overlay");
let close = document.querySelectorAll(".close-modal");
// let deviceUniqueId = document.querySelector('.device-id');
let changeDetails = document.querySelector(".change-details");
let monitorId = document.querySelector(".monitor-id");
let cpuId = document.querySelector(".cpu-id");
let keyboardId = document.querySelector(".keyboard-id");
let mouseId = document.querySelector(".mouse-id");
let displayIssueModal;
let changeIdModal;
let modalStatus = false;
let issuerId = document.querySelector(".issuer-id");
let id = document.querySelector(".issue-device");
let issueType = document.querySelector(".issue-type");
let issueDescription = document.querySelector(".issue-description");
let rows;
let newRedDevices = [];


// Set up reload timer
function startReloadTimer() {
  reloadInterval = setInterval(() => {
    if (!modalStatus) {
      window.location.reload();
    }
  }, 10000);
}
startReloadTimer();

const months = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
  "July",
  "August",
  "September",
  "October",
  "November",
  "December",
];

const days = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

const date = new Date();
let currentMonth = date.getMonth();
let currentYear = date.getFullYear();

const renderCalendar = () => {
  date.setDate(1);
  const firstDay = new Date(currentYear, currentMonth, 1);
  const lastDay = new Date(currentYear, currentMonth + 1, 0);
  const lastDayIndex = lastDay.getDay();
  const lastDayDate = lastDay.getDate();
  const prevLastDay = new Date(currentYear, currentMonth, 0);
  const prevLastDayDate = prevLastDay.getDate();
  const nextDays = 7 - lastDayIndex - 1;

  month.innerHTML = `${months[currentMonth]} ${currentYear}`;

  let days = "";

  for (let x = firstDay.getDay(); x > 0; x--) {
    days += `<div class="day prev">${prevLastDayDate - x + 1}</div>`;
  }

  for (let i = 1; i <= lastDayDate; i++) {
    if (
      i === new Date().getDate() &&
      currentMonth === new Date().getMonth() &&
      currentYear === new Date().getFullYear()
    ) {
      days += `<div class="day today">${i}</div>`;
    } else {
      days += `<div class="day">${i}</div>`;
    }
  }

  for (let j = 1; j <= nextDays; j++) {
    days += `<div class="day next">${j}</div>`;
  }

  daysContainer.innerHTML = days;
  hideTodayBtn();
};

nextBtn.addEventListener("click", () => {
  currentMonth++;
  if (currentMonth > 11) {
    currentMonth = 0;
    currentYear++;
  }
  renderCalendar();
});

prevBtn.addEventListener("click", () => {
  currentMonth--;
  if (currentMonth < 0) {
    currentMonth = 11;
    currentYear--;
  }
  renderCalendar();
});

todayBtn.addEventListener("click", () => {
  currentMonth = date.getMonth();
  currentYear = date.getFullYear();
  renderCalendar();
});

function hideTodayBtn() {
  if (
    currentMonth === new Date().getMonth() &&
    currentYear === new Date().getFullYear()
  ) {
    todayBtn.style.display = "none";
  } else {
    todayBtn.style.display = "flex";
  }
}

renderCalendar();

// function to validate new device details
function validateNewDeviceId(monitor, cpu, keyboard, mouse, individualDevice) {
  // if all new details empty
  if (monitor.value.trim() === "") {
    // alert('Monitor\'s Serial Number required');
    monitor.focus();
    return false;
  }
  if (cpu.value.trim() === "") {
    // alert('CPU\'s Serial Number required');
    cpu.focus();
    return false;
  }
  if (keyboard.value.trim() === "") {
    // alert('Keyboard\'s Serial Number required');
    keyboard.focus();
    return false;
  }
  if (mouse.value.trim() === "") {
    // alert('Mouse\'s Serial Number required');
    mouse.focus();
    return false;
  }

  // if all details are not valid
  if (monitor.value.length != "13") {
    alert("Monitor Serial Number is not valid");
    monitor.focus();
    return false;
  }
  if (cpu.value.length != "13") {
    alert("CPU Serial Number is not valid");
    cpu.focus();
    return false;
  }
  if (keyboard.value.length != "13") {
    alert("Keyboard Serial Number is not valid");
    keyboard.focus();
    return false;
  }
  if (mouse.value.length != "13") {
    alert("Mouse Serial Number is not valid");
    mouse.focus();
    return false;
  }

  return new Promise((resolve, reject) => {
    // ajax to check whether the entered new device unique id is already exists or not
    let xhrCheck = new XMLHttpRequest();
    xhrCheck.open("POST", "uniqueId.php", true);
    xhrCheck.setRequestHeader(
      "Content-Type",
      "application/x-www-form-urlencoded"
    );
    xhrCheck.onreadystatechange = function () {
      if (xhrCheck.readyState === XMLHttpRequest.DONE) {
        if (xhrCheck.status === 200) {
          let isAvailable = JSON.parse(xhrCheck.responseText);
          if (isAvailable) {
            resolve(isAvailable);
          } else {
            reject(
              new Error(
                "Serial Number is already assigned to another device. Please enter unique serial number"
              )
            );
          }
        } else {
          window.location.reload();
          reject(new Error("Error in checking device details."));
        }
      }
    };
    xhrCheck.send(
      `deviceId=${individualDevice.classList[0]}&monitorId=${monitorId.value}&cpuId=${cpuId.value}&keyboardId=${keyboardId.value}&mouseId=${mouseId.value}`
    );
  });
}

// show modal
function showModal(individualDevice) {
  modalStatus = true;
  // event.preventDefault();
  if (individualDevice.lastElementChild.lastElementChild.firstElementChild.getAttribute("fill") == "#F61216") {
    choice.classList.remove("visually-hidden");
    choice.classList.add("active");

    displayIssueModal = document.querySelector(".display-issue-modal");
    changeIdModal = document.querySelector(".change-id-modal");

    changeIdModal.addEventListener("click", (event) => {
      event.preventDefault();
      choice.classList.add("visually-hidden");
      choice.classList.remove("active");
      modal.classList.remove("visually-hidden");
      modal.classList.add("active");
    });

    displayIssueModal.addEventListener("click", (event) => {
      event.preventDefault();
      choice.classList.add("visually-hidden");
      choice.classList.remove("active");
      issueModal.classList.remove("visually-hidden");
      issueModal.classList.add("active");

      // ajax to display issuer's details
      let xhr = new XMLHttpRequest();
      xhr.open("POST", "ticket-details.php", true);
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            let result = JSON.parse(xhr.responseText);
            issuerId.value = result[1];
            let num = result[2];
            id.value = num.toUpperCase();
            issueType.value = result[3];
            issueDescription.value = result[4];
          } else {
            alert("Error Occured in displaying Device Issue");
          }
        }
      };
      xhr.send(`deviceId=${individualDevice.classList[0]}`);
    });
  }

  if (individualDevice.lastElementChild.lastElementChild.firstElementChild.getAttribute("fill") == "#699BF7") {
    modal.classList.remove("visually-hidden");
    modal.classList.add("active");
  }

  overlay.classList.remove("opacity-0", "z-n1");
  overlay.classList.add("opacity-100", "z-1");

  // ajax code to display device details in modal
  let xhr = new XMLHttpRequest();
  xhr.open("POST", "display_id.php", true);
  xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        try{
          let result = JSON.parse(xhr.responseText);
          monitorId.value = result[2];
          cpuId.value = result[3];
          keyboardId.value = result[4];
          mouseId.value = result[5];
        }catch{
          monitorId.value = ' ';
          cpuId.value = ' ';
          keyboardId.value = ' ';
          mouseId.value = ' ';
        }
        
      } else {
        alert("Error Occured in displaying Device's ID");
      }
    }
  };
  xhr.send(`deviceId=${individualDevice.classList[0]}`);

  // form is submitted to change device details
  changeDetails.addEventListener("click", (event) => {
    event.preventDefault();

    let request = validateNewDeviceId(monitorId,cpuId,keyboardId,mouseId,individualDevice);
    request.then(() => {
        // ajax to update the new device unique id
        let xhr = new XMLHttpRequest();
        xhr.open("POST", "updateDeviceId.php", true);
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onreadystatechange = function () {
          if (xhr.readyState === XMLHttpRequest.DONE) {
            if (xhr.status === 200) {
              window.location.reload();
              alert("Device ID updated successfully.");
            } else {
              alert("Error in updating Device ID.");
            }
          }
        };
        xhr.send(
          `deviceId=${individualDevice.classList[0]}&monitorId=${monitorId.value}&cpuId=${cpuId.value}&keyboardId=${keyboardId.value}&mouseId=${mouseId.value}`
        );
      })
      .catch((error) => {
        window.location.reload();
        alert(error);
      });
  });
}

// close modal
for (let singleClose of close) {
  singleClose.addEventListener("click", () => {
    if (modal.classList.contains("active")) {
      modal.classList.remove("active");
      modal.classList.add("visually-hidden");
      monitorId.value = "";
      cpuId.value = "";
      keyboardId.value = "";
      mouseId.value = "";
      modalStatus = false;
    }
    if (issueModal.classList.contains("active")) {
      issueModal.classList.remove("active");
      issueModal.classList.add("visually-hidden");
      issuerId.value = "";
      id.value = "";
      issueType.value = "";
      issueDescription.value = "";
      modalStatus = false;
    }
    if (choice.classList.contains("active")) {
      choice.classList.remove("active");
      choice.classList.add("visually-hidden");
      modalStatus = false;
    }

    overlay.classList.remove("opacity-100", "z-1");
    overlay.classList.add("opacity-0", "z-n1");
  });
}

async function createDevicesTop(row, totalDevices) {
  for (let i = totalDevices; i > 0; i--) {
    let deviceId;
    let devices = [];
    switch (row.classList[1]) {
      case "L1":
        deviceId = `L1-${i}`;
        break;
      case "L3":
        deviceId = `L3-${i}`;
        break;
      case "L5":
        deviceId = `L5-${i}`;
        break;
      case "L7":
        deviceId = `L7-${i}`;
        break;
      case "L9":
        deviceId = `L9-${i}`;
        break;
      case "L10":
        deviceId = `L10-${i}`;
        break;
      case "L12":
        deviceId = `L12-${i}`;
        break;
      case "L14":
        deviceId = `L14-${i}`;
        break;
      case "L15":
        deviceId = `L15-${i}`;
        break;
      case "L17":
        deviceId = `L17-${i}`;
        break;
      case "L19":
        deviceId = `L19-${i}`;
        break;
      case "L20":
        deviceId = `L20-${i}`;
        break;
      case "L22":
        deviceId = `L22-${i}`;
        break;
      case "L24":
        deviceId = `L24-${i}`;
        break;
    }
    await fetch("./img/svg top.svg")
      .then((response) => response.text())
      .then((svgContent) => {
        let parser = new DOMParser();
        let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

        let textElement = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "text"
        );
        textElement.textContent = i;
        textElement.setAttribute("x", "21");
        textElement.setAttribute("y", "37");
        textElement.setAttribute("fill", "#d3cedd");
        textElement.setAttribute("font-weight", "bold");

        let position = svgContent.lastIndexOf("</svg>");
        let updatedContent =
          svgContent.slice(0, position) +
          textElement.outerHTML +
          svgContent.slice(position);

        svgDocument.firstChild.insertBefore(
          textElement,
          svgDocument.firstChild.firstChild
        );

        row.appendChild(svgDocument.documentElement);

        row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg");
        row.lastElementChild.style = "cursor:pointer";
        devices.push(row.lastElementChild);

        // check whether someone have issues a problem or not
        for (let svg of row.childNodes) {
          let color;
          if (svg.nodeName === "svg") {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "issued_device.php", true);
            xhr.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  try {
                    color = JSON.parse(xhr.responseText);
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      color
                    );
                  } catch {
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      "#699BF7"
                    );
                  }
                } else {
                  alert("Error Occured.");
                }
              }
            };
            xhr.send(`deviceId=${svg.classList[0]}`);
          }
        }

        for (let device of devices) {
          device.addEventListener("click", () => {
            showModal(device);
          });
        }
      });
  }
}

async function createDevicesBottom(row, totalDevices) {
  for (let i = totalDevices; i > 0; i--) {
    let deviceId;
    let devices = [];
    switch (row.classList[1]) {
      case "L2":
        deviceId = `L2-${i}`;
        break;
      case "L4":
        deviceId = `L4-${i}`;
        break;
      case "L6":
        deviceId = `L6-${i}`;
        break;
      case "L8":
        deviceId = `L8-${i}`;
        break;
      case "L8":
        deviceId = `L8-${i}`;
        break;
      case "L11":
        deviceId = `L11-${i}`;
        break;
      case "L13":
        deviceId = `L13-${i}`;
        break;
      case "L16":
        deviceId = `L16-${i}`;
        break;
      case "L18":
        deviceId = `L18-${i}`;
        break;
      case "L21":
        deviceId = `L21-${i}`;
        break;
      case "L23":
        deviceId = `L23-${i}`;
        break;
    }
    await fetch("./img/svg bottom.svg")
      .then((response) => response.text())
      .then((svgContent) => {
        let parser = new DOMParser();
        let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

        let textElement = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "text"
        );
        textElement.textContent = i;
        textElement.setAttribute("x", "21");
        textElement.setAttribute("y", "27");
        textElement.setAttribute("fill", "#d3cedd");
        textElement.setAttribute("font-weight", "bold");

        let position = svgContent.lastIndexOf("</svg>");
        let updatedContent =
          svgContent.slice(0, position) +
          textElement.outerHTML +
          svgContent.slice(position);

        svgDocument.firstChild.insertBefore(
          textElement,
          svgDocument.firstChild.firstChild
        );
        row.appendChild(svgDocument.documentElement);

        row.lastElementChild.setAttribute("class", deviceId + " mb-1 svg");
        row.lastElementChild.style = "cursor:pointer";
        devices.push(row.lastElementChild);

        // check whether someone have issues a problem or not
        for (let svg of row.childNodes) {
          let color;
          if (svg.nodeName === "svg") {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "issued_device.php", true);
            xhr.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  try {
                    color = JSON.parse(xhr.responseText);
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      color
                    );
                  } catch {
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      "#699BF7"
                    );
                  }
                } else {
                  alert("Error Occured.");
                }
              }
            };
            xhr.send(`deviceId=${svg.classList[0]}`);
          }
        }

        for (let device of devices) {
          device.addEventListener("click", () => {
            showModal(device);
          });
        }
      });
  }
}

async function createOtherDevicesTop(row, totalDevices) {
  for (let i = 1; i <= totalDevices; i++) {
    let deviceId;
    let devices = [];
    switch (row.classList[1]) {
      case "L25":
        deviceId = `L25-${i}`;
        break;
      case "L27":
        deviceId = `L27-${i}`;
        break;
      case "L29":
        deviceId = `L29-${i}`;
        break;
    }
    await fetch("./img/svg top.svg")
      .then((response) => response.text())
      .then((svgContent) => {
        let parser = new DOMParser();
        let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

        let textElement = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "text"
        );
        textElement.textContent = i;
        textElement.setAttribute("x", "21");
        textElement.setAttribute("y", "37");
        textElement.setAttribute("fill", "#d3cedd");
        textElement.setAttribute("font-weight", "bold");

        let position = svgContent.lastIndexOf("</svg>");
        let updatedContent =
          svgContent.slice(0, position) +
          textElement.outerHTML +
          svgContent.slice(position);

        svgDocument.firstChild.insertBefore(
          textElement,
          svgDocument.firstChild.firstChild
        );
        row.appendChild(svgDocument.documentElement);

        row.lastChild.setAttribute("class", deviceId + " mt-1 svg");
        row.lastElementChild.style = "cursor:pointer";
        devices.push(row.lastElementChild);
        // check whether someone have issues a problem or not
        for (let svg of row.childNodes) {
          let color;
          if (svg.nodeName === "svg") {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "issued_device.php", true);
            xhr.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  try {
                    color = JSON.parse(xhr.responseText);
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      color
                    );
                  } catch {
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      "#699BF7"
                    );
                  }
                } else {
                  alert("Error Occured.");
                }
              }
            };
            xhr.send(`deviceId=${svg.classList[0]}`);
          }
        }

        for (let device of devices) {
          device.addEventListener("click", () => {
            showModal(device);
          });
        }
      });
  }
}

async function createOtherDevicesBottom(row, totalDevices) {
  for (let i = 1; i <= totalDevices; i++) {
    let deviceId;
    let devices = [];
    switch (row.classList[1]) {
      case "L26":
        deviceId = `L26-${i}`;
        break;
      case "L28":
        deviceId = `L28-${i}`;
        break;
    }
    await fetch("./img/svg bottom.svg")
      .then((response) => response.text())
      .then((svgContent) => {
        let parser = new DOMParser();
        let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

        let textElement = document.createElementNS(
          "http://www.w3.org/2000/svg",
          "text"
        );
        textElement.textContent = i;
        textElement.setAttribute("x", "21");
        textElement.setAttribute("y", "27");
        textElement.setAttribute("fill", "#d3cedd");
        textElement.setAttribute("font-weight", "bold");

        let position = svgContent.lastIndexOf("</svg>");
        let updatedContent =
          svgContent.slice(0, position) +
          textElement.outerHTML +
          svgContent.slice(position);

        svgDocument.firstChild.insertBefore(
          textElement,
          svgDocument.firstChild.firstChild
        );
        row.appendChild(svgDocument.documentElement);

        row.lastChild.setAttribute("class", deviceId + " mb-1  svg");
        row.lastElementChild.style = "cursor:pointer";
        devices.push(row.lastElementChild);

        // check whether someone have issues a problem or not
        for (let svg of row.childNodes) {
          let color;
          if (svg.nodeName === "svg") {
            let xhr = new XMLHttpRequest();
            xhr.open("POST", "issued_device.php", true);
            xhr.setRequestHeader(
              "Content-Type",
              "application/x-www-form-urlencoded"
            );
            xhr.onreadystatechange = function () {
              if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                  try {
                    color = JSON.parse(xhr.responseText);
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      color
                    );
                  } catch {
                    svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                      "fill",
                      "#699BF7"
                    );
                  }
                } else {
                  alert("Error Occured.");
                }
              }
            };
            xhr.send(`deviceId=${svg.classList[0]}`);
          }
        }

        for (let device of devices) {
          device.addEventListener("click", () => {
            showModal(device);
          });
        }
      });
  }
}

async function showPage() {
  rows = document.querySelectorAll(".rows");
  for (let row of rows) {
    if (row.classList[1] == "L1" ||row.classList[1] == "L3" ||row.classList[1] == "L5") {
      await createDevicesTop(row, "5").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L2" || row.classList[1] == "L4") {
      await createDevicesBottom(row, "5").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L6") {
      await createDevicesBottom(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L7") {
      await createDevicesTop(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L8") {
      await createDevicesBottom(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L9") {
      await createDevicesTop(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[2] == "L10-1") {
      for (let i = 5; i > 3; i--) {
        let deviceId = `L10-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "L10-2") {
      await createDevicesTop(row, "3").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-60",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L11" ||row.classList[1] == "L13" ||row.classList[1] == "L16" ||row.classList[1] == "L18" ||row.classList[1] == "L21" ||row.classList[1] == "L23") {
      await createDevicesBottom(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[2] == "L15-1") {
      for (let i = 5; i > 3; i--) {
        let deviceId = `L15-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "L15-2") {
      await createDevicesTop(row, "3").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-60",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L12" ||row.classList[1] == "L14" ||row.classList[1] == "L17" ||row.classList[1] == "L19" ||row.classList[1] == "L22" ||row.classList[1] == "L24") {
      await createDevicesTop(row, "9").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-25",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[2] == "L20-1") {
      for (let i = 5; i > 3; i--) {
        let deviceId = `L20-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "L20-2") {
      await createDevicesTop(row, "3").then(() => {
        let button = document.createElement("button");
        button.innerText = row.classList[1].toUpperCase();
        button.classList.add(
          "btn",
          "bg-white",
          "text-dark",
          "rounded",
          "btn-sm",
          "h-60",
          "mt-2"
        );
        row.appendChild(button);
      });
    }
    if (row.classList[1] == "L25" || row.classList[1] == "L27") {
      await createOtherDevicesTop(row, "4");
    }
    if (row.classList[1] == "L26") {
      await createOtherDevicesBottom(row, "4");
    }
    if (row.classList[1] == "L28") {
      await createOtherDevicesBottom(row, "3");
    }
    if (row.classList[1] == "L29") {
      await createOtherDevicesTop(row, "3");
    }

    // cabin devices
    // BO cabin
    if (row.classList[2] == "BO-L1-left") {
      let deviceId = "BO-L1-9";
      let devices = [];
      await fetch("./img/svg left.svg")
        .then((response) => response.text())
        .then((svgContent) => {
          let parser = new DOMParser();
          let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

          let textElement = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "text"
          );
          textElement.textContent = "9";
          textElement.setAttribute("x", "15");
          textElement.setAttribute("y", "32");
          textElement.setAttribute("fill", "#d3cedd");
          textElement.setAttribute("font-weight", "bold");

          let position = svgContent.lastIndexOf("</svg>");
          let updatedContent =
            svgContent.slice(0, position) +
            textElement.outerHTML +
            svgContent.slice(position);

          svgDocument.firstChild.insertBefore(
            textElement,
            svgDocument.firstChild.firstChild
          );
          row.appendChild(svgDocument.documentElement);

          row.lastElementChild.setAttribute(
            "class",
            deviceId + " mt-1 svg float-end"
          );
          row.lastElementChild.style = "cursor:pointer";
          devices.push(row.lastElementChild);

          // check whether someone have issues a problem or not
          for (let svg of row.childNodes) {
            let color;
            if (svg.nodeName === "svg") {
              let xhr = new XMLHttpRequest();
              xhr.open("POST", "issued_device.php", true);
              xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
              );
              xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                    try {
                      color = JSON.parse(xhr.responseText);
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        color
                      );
                    } catch {
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        "#699BF7"
                      );
                    }
                  } else {
                    alert("Error Occured.");
                  }
                }
              };
              xhr.send(`deviceId=${svg.classList[0]}`);
            }
          }

          for (let device of devices) {
            device.addEventListener("click", () => {
              showModal(device);
            });
          }
        });
    }
    if (row.classList[2] == "BO-L1-1") {
      for (let i = 8; i > 5; i--) {
        let deviceId = `BO-L1-${i}`;
        let devices = [];
        await fetch("./img/svg bottom.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "27");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mb-1 svg me-5");
            // console.log(row.firstElementChild);
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "BO-L1-2") {
      for (let i = 5; i > 0; i--) {
        let deviceId = `BO-L1-${i}`;
        let devices = [];
        await fetch("./img/svg bottom.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "27");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mb-1 svg ms-5");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "BO-L2-1") {
      for (let i = 8; i > 5; i--) {
        let deviceId = `BO-L2-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg me-5");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "BO-L2-2") {
      for (let i = 5; i > 0; i--) {
        let deviceId = `BO-L2-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg ms-5");
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[2] == "BO-L1-right") {
      let deviceId = "BO-L1-0";
      let devices = [];
      await fetch("./img/svg right.svg")
        .then((response) => response.text())
        .then((svgContent) => {
          let parser = new DOMParser();
          let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

          let textElement = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "text"
          );
          textElement.textContent = "0";
          textElement.setAttribute("x", "26");
          textElement.setAttribute("y", "32");
          textElement.setAttribute("fill", "#d3cedd");
          textElement.setAttribute("font-weight", "bold");

          let position = svgContent.lastIndexOf("</svg>");
          let updatedContent =
            svgContent.slice(0, position) +
            textElement.outerHTML +
            svgContent.slice(position);

          svgDocument.firstChild.insertBefore(
            textElement,
            svgDocument.firstChild.firstChild
          );
          row.appendChild(svgDocument.documentElement);

          row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg");
          row.lastElementChild.style = "cursor:pointer";
          devices.push(row.lastElementChild);

          // check whether someone have issues a problem or not
          for (let svg of row.childNodes) {
            let color;
            if (svg.nodeName === "svg") {
              let xhr = new XMLHttpRequest();
              xhr.open("POST", "issued_device.php", true);
              xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
              );
              xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                    try {
                      color = JSON.parse(xhr.responseText);
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        color
                      );
                    } catch {
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        "#699BF7"
                      );
                    }
                  } else {
                    alert("Error Occured.");
                  }
                }
              };
              xhr.send(`deviceId=${svg.classList[0]}`);
            }
          }

          for (let device of devices) {
            device.addEventListener("click", () => {
              showModal(device);
            });
          }
        });
    }

    // QC cabin
    if (row.classList[1] == "QC-L1-left") {
      let deviceId = "QC-L1-10";
      let devices = [];
      await fetch("./img/svg left.svg")
        .then((response) => response.text())
        .then((svgContent) => {
          let parser = new DOMParser();
          let svgDocument = parser.parseFromString(svgContent, "image/svg+xml");

          let textElement = document.createElementNS(
            "http://www.w3.org/2000/svg",
            "text"
          );
          textElement.textContent = "10";
          textElement.setAttribute("x", "10");
          textElement.setAttribute("y", "32");
          textElement.setAttribute("fill", "#d3cedd");
          textElement.setAttribute("font-weight", "bold");

          let position = svgContent.lastIndexOf("</svg>");
          let updatedContent =
            svgContent.slice(0, position) +
            textElement.outerHTML +
            svgContent.slice(position);

          svgDocument.firstChild.insertBefore(
            textElement,
            svgDocument.firstChild.firstChild
          );
          row.appendChild(svgDocument.documentElement);

          row.lastElementChild.setAttribute(
            "class",
            deviceId + " mt-1 svg float-end"
          );
          row.lastElementChild.style = "cursor:pointer";
          devices.push(row.lastElementChild);

          // check whether someone have issues a problem or not
          for (let svg of row.childNodes) {
            let color;
            if (svg.nodeName === "svg") {
              let xhr = new XMLHttpRequest();
              xhr.open("POST", "issued_device.php", true);
              xhr.setRequestHeader(
                "Content-Type",
                "application/x-www-form-urlencoded"
              );
              xhr.onreadystatechange = function () {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                  if (xhr.status === 200) {
                    try {
                      color = JSON.parse(xhr.responseText);
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        color
                      );
                    } catch {
                      svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                        "fill",
                        "#699BF7"
                      );
                    }
                  } else {
                    alert("Error Occured.");
                  }
                }
              };
              xhr.send(`deviceId=${svg.classList[0]}`);
            }
          }

          for (let device of devices) {
            device.addEventListener("click", () => {
              showModal(device);
            });
          }
        });
    }
    if (row.classList[1] == "QC-L1") {
      for (let i = 9; i > 0; i--) {
        let deviceId = `QC-L1-${i}`;
        let devices = [];
        await fetch("./img/svg bottom.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "27");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mb-1 svg me-5");
            // console.log(row.firstElementChild);
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
    if (row.classList[1] == "QC-L2") {
      for (let i = 9; i > 0; i--) {
        let deviceId = `QC-L2-${i}`;
        let devices = [];
        await fetch("./img/svg top.svg")
          .then((response) => response.text())
          .then((svgContent) => {
            let parser = new DOMParser();
            let svgDocument = parser.parseFromString(
              svgContent,
              "image/svg+xml"
            );

            let textElement = document.createElementNS(
              "http://www.w3.org/2000/svg",
              "text"
            );
            textElement.textContent = i;
            textElement.setAttribute("x", "21");
            textElement.setAttribute("y", "37");
            textElement.setAttribute("fill", "#d3cedd");
            textElement.setAttribute("font-weight", "bold");

            let position = svgContent.lastIndexOf("</svg>");
            let updatedContent =
              svgContent.slice(0, position) +
              textElement.outerHTML +
              svgContent.slice(position);

            svgDocument.firstChild.insertBefore(
              textElement,
              svgDocument.firstChild.firstChild
            );
            row.appendChild(svgDocument.documentElement);

            row.lastElementChild.setAttribute("class", deviceId + " mt-1 svg me-5");
            // console.log(row.firstElementChild);
            row.lastElementChild.style = "cursor:pointer";
            devices.push(row.lastElementChild);

            // check whether someone have issues a problem or not
            for (let svg of row.childNodes) {
              let color;
              if (svg.nodeName === "svg") {
                let xhr = new XMLHttpRequest();
                xhr.open("POST", "issued_device.php", true);
                xhr.setRequestHeader(
                  "Content-Type",
                  "application/x-www-form-urlencoded"
                );
                xhr.onreadystatechange = function () {
                  if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                      try {
                        color = JSON.parse(xhr.responseText);
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          color
                        );
                      } catch {
                        svg.lastElementChild.lastElementChild.firstElementChild.setAttribute(
                          "fill",
                          "#699BF7"
                        );
                      }
                    } else {
                      alert("Error Occured.");
                    }
                  }
                };
                xhr.send(`deviceId=${svg.classList[0]}`);
              }
            }

            for (let device of devices) {
              device.addEventListener("click", () => {
                showModal(device);
              });
            }
          });
      }
    }
  }
}

showPage().then(() => {
  // check which cabin have issue
  let cabins = document.querySelectorAll('.cabin-btn')
  cabins.forEach(cabin => {
    // console.log(cabin.classList);
    let xhr = new XMLHttpRequest();
      xhr.open("POST", "issued_device.php", true);
      xhr.setRequestHeader(
        "Content-Type",
        "application/x-www-form-urlencoded"
      );
      xhr.onreadystatechange = function () {
        if (xhr.readyState === XMLHttpRequest.DONE) {
          if (xhr.status === 200) {
            try {
              color = JSON.parse(xhr.responseText);
              cabin.classList.add('border-danger');
            } catch {
            }
          }
        }
      };
      xhr.send(`deviceId=${cabin.classList[0]}`);
  });

  let issuedDevice;
  let svgs = document.querySelectorAll('.svg');

  svgs.forEach(svg => {
    issuedDevice = svg.lastElementChild.lastElementChild.firstElementChild.getAttribute('fill');
    if (issuedDevice === '#F61216') {
      newRedDevices.push(svg.classList[0]);
    }
  })
 
  // play notification
  if(newRedDevices.length>0){
    let notify = new Audio('./mixkit-basketball-buzzer-1647.mp3');
      notify.play();
  }
})

