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

/* Main aside JS - Search and Create Channel */
let asideWithSearchBtn = document.querySelector('.aside.with-subscribe, .aside#main-aside');
if(asideWithSearchBtn) {
    let adjustHeights = () => {
        createChannelAside.classList.remove('no-display');
        searchAside.classList.remove('no-display');
        createChannelAside.style.height = asideWithSearchBtn.offsetHeight + "px";
        searchAside.style.height = asideWithSearchBtn.offsetHeight + "px";
    };
                            /* SEARCH ASIDE */
    // Search handling
    let searchButton = asideWithSearchBtn.querySelector('#search-button');
    let searchAside = document.querySelector('#search-aside');
    searchButton.onclick = () => {
        adjustHeights();
        asideWithSearchBtn.classList.toggle('rotate-180Y');
        searchAside.classList.remove('hidden');
        searchAside.classList.toggle('rotate-180Y');
    };
                           /* CREATE CHANNEL ASIDE */
    // Create channel handling
    let createChannelAside = document.querySelector('#create-channel-aside');
    let createChannelButton = asideWithSearchBtn.querySelector('#create-channel-button');
    createChannelButton.onclick = () => {
        adjustHeights();
        asideWithSearchBtn.classList.toggle('rotate-180Y');
        createChannelAside.classList.remove('hidden');
        createChannelAside.classList.toggle('rotate-180Y');
    };
    // Handle cancel button.
    createChannelAside.querySelector('.cancel-button').onclick = () => {
        asideWithSearchBtn.classList.toggle('rotate-180Y');
        createChannelAside.classList.toggle('rotate-180Y');
        return false;
    };
    // Handle image upload preview
    let previewDiv = createChannelAside.querySelector('#channel-upload-image');
    createChannelAside.querySelector('input[type="file"]').onchange = (e) => {
        previewDiv.style.background = `url('${URL.createObjectURL(event.target.files[0])}') center/cover`;
    };
    // Prevent form submission.
    createChannelAside.querySelector('form').onsubmit = (e) => {
        e.preventDefault();
    }
}

/* Upvote/ Downvote Ajax */
let storyAside = document.querySelector('.sc-aside');
if(storyAside) {
    let upvoteButton = storyAside.querySelector('.arrow-up i');
    let downvoteButton = storyAside.querySelector('.arrow-down i');
    let points = storyAside.querySelector('#points');

    let clear_vote = () => {
        makeHTTPRequest('../actions/action_points.php', 
        'post', 
        {action: 'clear_vote', post: upvoteButton.getAttribute('data-id'), csrf: csrf}, () => { });    
    }

    upvoteButton.onclick = () => {
        clear_vote();
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
            {action: 'upvote', post: upvoteButton.getAttribute('data-id'), csrf: csrf}, () => { });
        }
    }
    downvoteButton.onclick = () => {
        clear_vote();
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
            {action: 'downvote', post: downvoteButton.getAttribute('data-id'), csrf: csrf}, () => { });
        }
    }
}

/* Comment Ajax */
let commentForm = document.querySelector('#comments form');
let comments = document.querySelectorAll('#comment');
if (commentForm) {

    let contentField = commentForm.querySelector('input[name="content"]');
    let comment_el = document.getElementById("comments");

    commentForm.onsubmit = (e) => {
        e.preventDefault();
        // Ajax request
        makeHTTPRequest('../actions/action_comment.php', 
            'post', 
            {   
                content: contentField.value, 
                post: commentForm.getAttribute('data-id')
            }, 
            (new_comment) => {
                commentForm.reset();

                // amkes sure the user is loged in
                if (new_comment == 'fail')
                    window.location.replace("./main.php");
                else
                    comment_el.insertBefore(createComment(new_comment), comments[0]);
            }
        );
    }
}

/**
 * Creates the html to temporarily add the new comment (until the page is refreshed)
 * @param {String} new_comment_str The values of the new comment divided by |
 */
function createComment(new_comment_str) {
    // info in each index value
    let content_index = 1, points_index = 4, author_name = 5, posted_ago = 7, time = 8;

    // tests if the string is valid
    if(new_comment_str == "" || !new_comment_str)
        return;
        
    // splits received string to an array
    let new_comment = new_comment_str.split("|");


    
    // creates the user
    let user = document.createElement('a');
    user.setAttribute('class', 'author-name');
    user.setAttribute('href', './profile.php?user=' + new_comment[author_name]);
    user.innerText = "" + new_comment[author_name];

    // creates the date
    let date = document.createElement('p');
    date.setAttribute('class', 'date');
    date.setAttribute('title', '' + new_comment[time]);
    date.innerText = "" + new_comment[posted_ago];

    // creates the points
    let points = document.createElement('p');
    points.setAttribute('class', 'points');
    points.innerText = "" + new_comment[points_index] + " points";


    // gets the rely already defined in other elements
    let reply = document.getElementById("reply");

    // gets the arrows already defined in other elements
    let arrows = document.getElementById("arrows");

    // creates the header
    let header = document.createElement('header');
    header.innerHTML = user.outerHTML + date.outerHTML 
                    + points.outerHTML + reply.outerHTML
                    + arrows.outerHTML;

    // creates the content
    let content = document.createElement('p');
    content.setAttribute('class', 'lg-content');
    content.innerText = "" + new_comment[content_index];

    //creates the body
    let body = document.createElement('div');
    body.setAttribute('class', 'body');
    body.innerHTML = content.outerHTML;

    let new_comment_html = document.createElement('article');
    new_comment_html.setAttribute('id', 'comment');
    new_comment_html.innerHTML = header.outerHTML + body.outerHTML;

    return new_comment_html;

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