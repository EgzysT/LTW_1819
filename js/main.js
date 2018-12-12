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
                    setTimeout(function(){ window.location.replace(document.referrer); }, 500);
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

/* Main aside JS - Create Channel */
let mainAside = document.querySelector('.aside.with-subscribe, .aside#main-aside');
if(mainAside) {
    let adjustHeights = () => {
        if(createChannelAside) 
            createChannelAside.style.height = mainAside.offsetHeight + "px";
    };
                           /* CREATE CHANNEL ASIDE */
    // Create channel handling
    let createChannelAside = document.querySelector('#create-channel-aside');
    let createChannelButton = document.querySelector('#create-channel-button');
    if(createChannelButton) // Not available if user isn't logged in.
    {
        createChannelButton.onclick = () => {
            adjustHeights();
            mainAside.classList.toggle('rotate-180Y');
            createChannelAside.classList.remove('hidden');
            createChannelAside.classList.remove('no-display');
            setTimeout(() => {
                createChannelAside.classList.toggle('rotate-180Y');
            }, 20);
        };
        // Handle cancel button.
        createChannelAside.querySelector('.cancel-button').onclick = () => {
            mainAside.classList.toggle('rotate-180Y');
            createChannelAside.classList.toggle('rotate-180Y');
            return false;
        };
        // Handle image upload preview
        let previewDiv = createChannelAside.querySelector('#channel-upload-image');
        createChannelAside.querySelector('input[type="file"]').onchange = (e) => {
            previewDiv.style.background = `url('${URL.createObjectURL(event.target.files[0])}') center/cover`;
        };
        // Handle form submission.
        let loginAjaxContainer = document.querySelector('#ajax-form-container');
        let ajaxRequestBox = loginAjaxContainer.querySelector('#ajax-form-request-fill');
        let ajaxFailBox = loginAjaxContainer.querySelector('#ajax-form-failure-fill');
        let ajaxSuccessBox = loginAjaxContainer.querySelector('#ajax-form-success-fill');
        let createChannelForm = loginAjaxContainer.querySelector('form');
        createChannelForm.onsubmit = (e) => {
            e.preventDefault();
            ajaxRequestBox.style.display = 'flex';
            // Do special xhr request.
            let formData = new FormData(createChannelForm);
            let channel_name = formData.get('channel_name');
            let xhr = new XMLHttpRequest();
            xhr.open('POST', '../actions/action_create_channel.php', true);
            xhr.addEventListener("load", function () {
                let response = this.responseText;
                console.log(response);
                if(response !== 'ok') { 
                    ajaxFailBox.style.display = 'flex';
                    ajaxFailBox.querySelector('#error-message').innerHTML = response;
                }
                else {
                    ajaxSuccessBox.style.display = 'flex';
                    // Redirect user after 1s.
                    setTimeout(function(){window.location.replace(`./channel.php?name=${channel_name}`); }, 1000);
                }
                ajaxRequestBox.style.display = 'none';
            });
            xhr.send(formData);
        }
        // Close failure ajax box button handler.
        ajaxFailBox.querySelector('button').onclick = () => {
            ajaxFailBox.style.display = 'none';
        }
    }
}

/* Story submission functions */
let submitStoryForm = document.querySelector('#submit-story-form');
if (submitStoryForm) {
    /* Handle signup submission trough AJAX */
    let loginAjaxContainer = document.querySelector('#ajax-form-container');
    let ajaxRequestBox = loginAjaxContainer.querySelector('#ajax-form-request-fill');
    let ajaxFailBox = loginAjaxContainer.querySelector('#ajax-form-failure-fill');
    let ajaxSuccessBox = loginAjaxContainer.querySelector('#ajax-form-success-fill');

    let titleField = submitStoryForm.querySelector('input[name="story_title"]');
    let textField = submitStoryForm.querySelector('textarea[name="story_text"]');
    let channelName = submitStoryForm.querySelector('.channel-name a').textContent.substr(1);

    // Submit form handler.
    submitStoryForm.onsubmit = (e) => {
        e.preventDefault();
        ajaxRequestBox.style.display = 'flex';
        // Ajax request
        makeHTTPRequest('../actions/action_submission.php', 
            'post', 
            {   channel_name: channelName, 
                story_title: titleField.value, 
                story_text: textField.value,
                csrf: csrf
            }, 
            (response) => { /* callback */
                if(response === 'ok') { // Nasty trick to see if a number was returned.
                    ajaxSuccessBox.style.display = 'flex';
                    // Redirect user after 1s.
                    setTimeout(function(){window.location.replace(`./channel.php?name=${channelName}`); }, 1000);
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

/* Search Modal */
let searchModal = document.querySelector('.modal-search');
if(searchModal) {
    let searchButton = document.querySelector('#search-button');
    let cancelButtons = searchModal.querySelectorAll('.modal-close');
    let outerBackground = document.querySelector('#modal-outer-background');

    let closeModal = (e) => {
        if(e)
            e.preventDefault();
        searchModal.classList.add('no-display');
        outerBackground.classList.add('no-display');
    }
    let openModal = () => {
        searchModal.classList.remove('no-display');
        outerBackground.classList.remove('no-display');
    };
    
    for(let cancelButton of cancelButtons) {
        cancelButton.onclick = closeModal;
    }
    searchButton.onclick = openModal;
}

/* Upvote/ Downvote for stories Ajax */
let storyAside = document.querySelector('.sc-aside');
if(storyAside) {
    let upvoteButton = storyAside.querySelector('.arrow-up i');
    let downvoteButton = storyAside.querySelector('.arrow-down i');
    let points = storyAside.querySelector('#points');

    if (downvoteButton && upvoteButton && points)
        addVotesEvents(downvoteButton, upvoteButton, points);
}

/* Upvote/ Downvote for comments Ajax */
let comments = document.querySelectorAll('.comment');
if(comments) {

    for (let comment of comments) {
        let upvoteButton = comment.querySelector('.arrow-up i');
        let downvoteButton = comment.querySelector('.arrow-down i');
        let points = comment.querySelector('.points');

        if (downvoteButton && upvoteButton && points)
            addVotesEvents(downvoteButton, upvoteButton, points);
    }
}

/**
 * Upvote and Downvote events ajax
 * @param {HTML} downvoteButton 
 * @param {HTML} upvoteButton 
 * @param {HTML} points 
 */
function addVotesEvents(downvoteButton, upvoteButton, points) {
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

/* Comment form Ajax */
let commentForm = document.querySelector('#comments form');
if (commentForm && comments) {

    let contentField = commentForm.querySelector('textarea[name="content"]');
    let comment_el = document.getElementById("comments");

    // main comment form - the one that appears after the story
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

    // reply forms and buttons
    for (let comment of comments) {
        addReplyFormEvents(comment);
    }
}

// shows the reply forms when reply is clicked and handles submission
function addReplyFormEvents (comment) {

    let reply = comment.querySelector('.reply');

    if (reply) {

        // the current form is the first form of the array
        let curr_reply_div = comment.querySelector('.reply-form');
        let replyForm = curr_reply_div.querySelector('.comment-form');

        let contentField_reply = replyForm.querySelector('textarea[name="content"]');
        let subcomment_div = comment.querySelector('.subcomments');
        let subcomments = comment.querySelectorAll('.comment');

        // when clicking the reply form appears
        reply.onclick = () => {
            if (curr_reply_div.style.display == 'block')
                curr_reply_div.style.display = 'none';
            else
                curr_reply_div.style.display = 'block';
        }

        // add the comment after submission
        replyForm.onsubmit = (e) => {
            e.preventDefault();
            makeHTTPRequest('../actions/action_comment.php', 
            'post', 
            {   
                content: contentField_reply.value, 
                post: replyForm.getAttribute('data-id')
            }, 
            (new_comment) => {
                // resets the form to its initials values
                replyForm.reset();
                // hides the form
                curr_reply_div.style.display = 'none';

                // makes sure the user is loged in
                if (new_comment == 'fail')
                    window.location.replace("./main.php");
                else
                    subcomment_div.insertBefore(createComment(new_comment), subcomments[0]);
            }
        );
        }
    }
}

/**
 * Creates the html to temporarily add the new comment (until the page is refreshed)
 * @param {String} new_comment_str The values of the new comment divided by |
 */
function createComment(new_comment_str) {
    // info in each index value
    let id_index = 0, content_index = 1, points_index = 4, author_name = 5, posted_ago = 7, time = 8;

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
    points.innerText = "" + new_comment[points_index];

    let points_wrd = document.createElement('p');
    points_wrd.setAttribute('class', 'points');
    points_wrd.innerText = "points";

    //creates font awesome i for reply		    
    let reply_fa = document.createElement('i');		     
    reply_fa.setAttribute('class', 'far fa-comment-alt');		
       
    // creates reply		     
    let reply = document.createElement('div');		   
    reply.setAttribute('class', 'reply');		
    reply.setAttribute('data-id', '' + new_comment[id_index]);
    reply.innerHTML = ""+ reply_fa.outerHTML + "<p> reply</p>";		
       
    // create arrow up		    
    let arrow_up_fa = document.createElement('i');		
    arrow_up_fa.setAttribute('data-id', '' + new_comment[id_index]);
    arrow_up_fa.setAttribute('class', 'fas fa-arrow-alt-circle-up');		
       
    let arrow_up = document.createElement('p');		
    arrow_up.setAttribute('class', 'arrow-up');
    arrow_up.innerHTML = arrow_up_fa.outerHTML;		
       
    // create arrow down		
    let arrow_down_fa = document.createElement('i');		
    arrow_down_fa.setAttribute('class', 'fas fa-arrow-alt-circle-down');		
       
    let arrow_down = document.createElement('p');		
    arrow_down.setAttribute('class', 'arrow-down');		
    arrow_down_fa.setAttribute('data-id', '' + new_comment[id_index]);
    arrow_down.innerHTML = arrow_down_fa.outerHTML;		
       
    // creates arrows
    let arrows = document.createElement('div');		
    arrows.setAttribute('class', 'arrows');		
    arrows.innerHTML = arrow_up.outerHTML + arrow_down.outerHTML;


    // creates the header
    let header = document.createElement('header').cloneNode();
    header.innerHTML = user.outerHTML + date.outerHTML 
                    + points.outerHTML + points_wrd.outerHTML
                    + reply.outerHTML + arrows.outerHTML;

    // creates the content
    let content = document.createElement('p');
    content.setAttribute('class', 'lg-content');
    content.innerHTML =  new_comment[content_index];
    //creates the body
    let body = document.createElement('div');
    body.setAttribute('class', 'body');
    body.innerHTML = content.outerHTML;


    //creates the input content class
    let reply_form = document.createElement('div');
    reply_form.setAttribute('class', 'reply-form');

    let comment_form = document.getElementsByClassName('comment-form')[0].cloneNode(true);
    comment_form.setAttribute('data-id', '' + new_comment[id_index]);

    reply_form.innerHTML = commentForm.outerHTML;

    //creates subcomments div
    let subcomments = document.createElement('div');
    subcomments.setAttribute('class', 'subcomments');

    // creates the comment
    let new_comment_html = document.createElement('article');
    new_comment_html.setAttribute('class', 'comment');
    new_comment_html.innerHTML = header.outerHTML + body.outerHTML 
                                + reply_form.outerHTML + subcomments.outerHTML;
                                // + comment_warning.outerHTML;


    addReplyFormEvents(new_comment_html);

    let upvoteButton = new_comment_html.querySelector('.arrow-up i');
    let downvoteButton = new_comment_html.querySelector('.arrow-down i');
    let points_nr = new_comment_html.querySelector('.points');

    addVotesEvents(downvoteButton, upvoteButton, points_nr);

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