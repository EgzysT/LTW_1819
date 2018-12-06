'use strict';

let csrf = document.querySelector('meta[name="csrf-token"]').content;

/* Signup page functions */
let signupForm = document.querySelector('#signup-form');
if (signupForm) {
    /* Handle signup submission trough AJAX */
    let loginAjaxContainer = document.querySelector('#ajax-form-container');
    let ajaxRequestBox = loginAjaxContainer.querySelector('#ajax-form-request-fill');
    let ajaxFailBox = loginAjaxContainer.querySelector('#ajax-form-failure-fill');
    let ajaxSuccessBox = loginAjaxContainer.querySelector('#ajax-form-success-fill');

    let usernameField = signupForm.querySelector('input[name="username"]');
    let emailField = signupForm.querySelector('input[name="email"]');
    let passwordField = signupForm.querySelector('input[name="password"]');
    let confirmPasswordField = signupForm.querySelector('input[name="confirm_password"]');

    // Submit form handler.
    signupForm.onsubmit = (e) => {
        e.preventDefault();
        ajaxRequestBox.style.display = 'flex';
        // Ajax request
        makeHTTPRequest('../actions/action_signup.php', 
            'post', 
            {   username: usernameField.value, 
                email: emailField.value, 
                password: passwordField.value,
                confirm_password: confirmPasswordField.value
            }, 
            (response) => { /* callback */
                if(response === 'ok') { 
                    ajaxSuccessBox.style.display = 'flex';
                    // Redirect user after 0.5s.
                    setTimeout(function(){ window.location.replace("./main.php"); }, 500);
                }
                else { // Error.
                    ajaxFailBox.style.display = 'flex';
                    ajaxFailBox.querySelector('#error-message').innerHTML = response;
                }
                ajaxRequestBox.style.display = 'none';
            }
        );
    }

    // Close failure ajax box button handler.
    ajaxFailBox.querySelector('button').onclick = () => {
        ajaxFailBox.style.display = 'none';
    }
}

/* Login page functions */
let loginForm = document.querySelector('#login-form');
if (loginForm) {
    /* Handle login submission trough AJAX */
    let loginAjaxContainer = document.querySelector('#ajax-form-container');
    let ajaxRequestBox = loginAjaxContainer.querySelector('#ajax-form-request-fill');
    let ajaxFailBox = loginAjaxContainer.querySelector('#ajax-form-failure-fill');
    let ajaxSuccessBox = loginAjaxContainer.querySelector('#ajax-form-success-fill');

    let usernameField = loginForm.querySelector('input[name="username"]');
    let passwordField = loginForm.querySelector('input[name="password"]');

    // Submit form handler.
    loginForm.onsubmit = (e) => {
        e.preventDefault();
        ajaxRequestBox.style.display = 'flex';
        // Ajax request
        makeHTTPRequest('../actions/action_login.php', 
            'post', 
            {username: usernameField.value, password: passwordField.value}, 
            (response) => { /* callback */
                if(response === 'ok') { 
                    ajaxSuccessBox.style.display = 'flex';
                    // Redirect user after 0.5s.
                    setTimeout(function(){ window.location.replace("./main.php"); }, 500);
                }
                else if(response === 'fail') { 
                    ajaxFailBox.style.display = 'flex';
                }
                ajaxRequestBox.style.display = 'none';
            }
        );
    }
    // Close failure ajax box button handler.
    ajaxFailBox.querySelector('button').onclick = () => {
        ajaxFailBox.style.display = 'none';
    }

}

/* Channel Subscribe related JS */
let asideChannel = document.querySelector('.channel .aside-channel.with-subscribe');
if(asideChannel) {
    let subscribeButton = asideChannel.querySelector('#subscribe');
    let unsubscribeButton = asideChannel.querySelector('#unsubscribe');
    let channel_name = asideChannel.querySelector('#channel_name').textContent;
    let toggleRotation = () => {
        subscribeButton.classList.toggle('rotate-180Y');
        unsubscribeButton.classList.toggle('rotate-180Y');
    }
    // User subscribes.
    subscribeButton.onclick = () => {
        toggleRotation();
        makeHTTPRequest('../actions/action_subscribe.php', 
        'post', 
        {action: 'subscribe', channel_name: channel_name, csrf: csrf}, (response) => { console.log(response) });
    }
    // User unsubscribes.
    unsubscribeButton.onclick = () => {
        toggleRotation();
        makeHTTPRequest('../actions/action_subscribe.php', 
        'post', 
        {action: 'unsubscribe', channel_name: channel_name, csrf: csrf}, (response) => { console.log(response) });
    }
}

/* Search aside animation + Search handler */
let asideWithSearchBtn = document.querySelector('.aside.with-subscribe, .aside#main-aside');
if(asideWithSearchBtn) {
    let searchButton = asideWithSearchBtn.querySelector('#search-button');
    let searchAside = document.querySelector('#search-aside');
    searchButton.onclick = () => {
        asideWithSearchBtn.classList.toggle('rotate-180Y');
        searchAside.classList.toggle('rotate-180Y');
    };
}

/* Upvote/ Downvote Ajax */
let storyAside = document.querySelector('.full-story-card .sc-aside');
if(storyAside) {
    let upvoteButton = storyAside.querySelector('.arrow-up i');
    let downvoteButton = storyAside.querySelector('.arrow-down i');
    let points = storyAside.querySelector('#points');

    upvoteButton.onclick = () => {
        if(upvoteButton.classList.contains('selected')) {
            upvoteButton.classList.remove('animate-up');
            upvoteButton.classList.remove('selected');
            points.textContent--;
        }
        else { 
            upvoteButton.classList.add('animate-up');
            upvoteButton.classList.add('selected');

            if(!downvoteButton.classList.contains('selected'))
                points.textContent++;
            else
                points.textContent = Number(points.textContent) + 2;

            downvoteButton.classList.remove('selected');
            downvoteButton.classList.remove('animate-down');
            makeHTTPRequest('../actions/action_points.php', 
            'post', 
            {action: 'upvote', post: upvoteButton['data-id'], csrf: csrf}, (response) => { alert(response); });
        }
    }
    downvoteButton.onclick = () => {
        if(downvoteButton.classList.contains('selected')) {
            downvoteButton.classList.remove('animate-down');
            downvoteButton.classList.remove('selected');
            points.textContent++;
        }
        else { 
            downvoteButton.classList.add('animate-down');
            downvoteButton.classList.add('selected');

            if(!upvoteButton.classList.contains('selected'))
                points.textContent--;
            else
                points.textContent = Number(points.textContent) - 2;

            upvoteButton.classList.remove('selected');
            upvoteButton.classList.remove('animate-up');
            makeHTTPRequest('../actions/action_points.php', 
            'post', 
            {action: 'downvote', post: downvoteButton['data-id'], csrf: csrf}, (response) => { alert(response); });
        }
    }
}

/* Helper functions */
function makeHTTPRequest(url, type, params, callback) {
    let request = new XMLHttpRequest();
    request.open(type, url, true);
    request.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    request.addEventListener("load", function () {
        callback(this.responseText);
    })  
    request.send(encodeForAjax(params));
}

function encodeForAjax(data) {
    return Object.keys(data).map(function(k){
      return encodeURIComponent(k) + '=' + encodeURIComponent(data[k]);
    }).join('&');
}