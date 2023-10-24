(function() {
  "use strict";
  
  // http -> https
  //if (location.protocol !== "https:") {
  //  location.href = "https:" + location.href.substring(location.protocol.length);
  //}
  
  
  var loginStatusIcon = document.getElementById("login-status-icon");
  
  var loginModalLaunch = document.getElementById("login-modal-launch");
  var loginModal = document.querySelector(".login-modal");
  var loginModalLoginBtn = document.querySelector(".login-modal .login-btn");
  var loginModalCloseBtn = document.querySelector(".login-modal .close-btn");
  
  var boardModalLaunch = document.getElementById("board-modal-launch");
  var boardModal = document.querySelector(".board-modal");
  var boardModalSaveBtn = document.querySelector(".board-modal .save-btn");
  var boardModalLogoutBtn = document.querySelector(".board-modal .logout-btn");
  var boardModalCloseBtn = document.querySelector(".board-modal .close-btn");
  
  console.log("document ready (auth.js) initializeApp:" + firebase.app().name); // "[DEFAULT]"
  
  // 알림판
  firebase
    .database()
    .ref("waitingBoard")
    .on("value", function(snapshot) {
      var displayUpdateCount = document.querySelector(".sign.wait .updateCount");
      var displayTitle = document.querySelector(".sign.wait .title");
      var displayAppointWait = document.querySelector(".sign.wait .appointWait");
      var displayTestWait = document.querySelector(".sign.wait .testWait");
      var displayEstimatedWaitHour = document.querySelector(".sign.wait .estimatedWaitHour");
      var displayEstimatedWaitMin = document.querySelector(".sign.wait .estimatedWaitMin");
      displayUpdateCount.innerText = snapshot.val().updateCount;
      displayTitle.innerText = snapshot.val().title;
      displayAppointWait.innerText = snapshot.val().appointWait;
      displayTestWait.innerText = snapshot.val().testWait;
      displayEstimatedWaitHour.innerText = snapshot.val().estimatedWaitHour;
      displayEstimatedWaitMin.innerText = snapshot.val().estimatedWaitMin;
      
      const inputTitle = document.querySelector(".board-modal [name='title']");
      const inputAppointWait = document.querySelector(".board-modal [name='appointWait']");
      const inputTestWait = document.querySelector(".board-modal [name='testWait']");
      const inputEstimatedWaitHour = document.querySelector(".board-modal [name='estimatedWaitHour']");
      const inputEstimatedWaitMin = document.querySelector(".board-modal [name='estimatedWaitMin']");
      inputTitle.value = snapshot.val().title;
      inputAppointWait.value = snapshot.val().appointWait;
      inputTestWait.value = snapshot.val().testWait;
      inputEstimatedWaitHour.value = snapshot.val().estimatedWaitHour;
      inputEstimatedWaitMin.value = snapshot.val().estimatedWaitMin;
    });
  
  // 로그인 여부
  firebase.auth().onAuthStateChanged(function(authUser) {
    //console.log("onAuthStateChanged");
    
    if (authUser) {
      //console.log(authUser.uid);
      firebase
        .database()
        .ref("users/" + authUser.uid)
        .once("value", function(snapshot) {
          var status = "";
          var today = new Date(Date.now()).toISOString().substring(0, 10);
          
          if (snapshot.val().isPayment) {
            if (snapshot.val().endDate >= today) {
              status = '서비스';
            } else if (snapshot.val().endDate < today) {
              status = '만료됨';
            }
          } else {
            status = '미결제';
          }
          
          var userInfo = {
            uid: authUser.uid,
            email: authUser.email,
            status: status,
            startDate: snapshot.val().startDate,
            endDate: snapshot.val().endDate
          };
          
          console.log(userInfo);
        });
      
      loginStatusIcon.style.display = "none";
      loginModalLaunch.style.display = "none";
      boardModalLaunch.style.display = "inline";
      
    } else {
      console.log("Not login");
      
      loginStatusIcon.style.display = "none";
      loginModalLaunch.style.display = "inline";
      boardModalLaunch.style.display = "none";
    }
  });
  
  
  
  // Login
  loginModalLaunch.addEventListener("click", function(e) {
    e.preventDefault();
    loginModal.style.display = "block";
  });
  
  loginModalLoginBtn.addEventListener("click", function(e) {
    e.preventDefault();
    
    const email = document.querySelector(".login-modal [name='email']").value;
    const password = document.querySelector(".login-modal [name='password']").value;
    
    // session 방식
    firebase
      .auth()
      .setPersistence(firebase.auth.Auth.Persistence.SESSION)
      .then(function() {
        firebase
          .auth()
          .signInWithEmailAndPassword(email, password)
          .then(function(result) {
            //console.log(result.email + " logged in");
            //console.log(firebase.auth);
            loginModal.style.display = "none";
          })
          .catch(function(err) {
            alert(err.message);
            console.log(err);
          });
      })
      .catch(function(error) {
        console.log(err);
      });
  });
  
  loginModalCloseBtn.addEventListener("click", function(e) {
    e.preventDefault();
    loginModal.style.display = "none";
  });
  
  
  
  // Board
  boardModalLaunch.addEventListener("click", function(e) {
    e.preventDefault();
    boardModal.style.display = "block";
  });
  
  boardModalSaveBtn.addEventListener("click", function(e) {
    e.preventDefault();
    
    var waitingData = {
      updateCount: 100,
      title: document.querySelector(".board-modal [name='title']").value,
      appointWait: document.querySelector(".board-modal [name='appointWait']").value,
      testWait: document.querySelector(".board-modal [name='testWait']").value,
      estimatedWaitHour: document.querySelector(".board-modal [name='estimatedWaitHour']").value,
      estimatedWaitMin: document.querySelector(".board-modal [name='estimatedWaitMin']").value
    };
    
    firebase.database().ref("waitingBoard").set(waitingData);
    
    boardModal.style.display = "none";
  });
  
  boardModalLogoutBtn.addEventListener("click", function(e) {
    e.preventDefault();
    firebase.auth().signOut();
    boardModal.style.display = "none";
  });
  
  boardModalCloseBtn.addEventListener("click", function(e) {
    e.preventDefault();
    boardModal.style.display = "none";
  });
  
})();
