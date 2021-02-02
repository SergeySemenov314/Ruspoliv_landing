$(document).ready(function () {

  //--------------------------------------------------- header menu

  const menuToggle = document.querySelector('#menu-toggle');

  const mobileNavContainer = document.querySelector('#mobile-nav');

  const menuItems = mobileNavContainer.querySelectorAll('.mobile-nav-link');

  menuToggle.onclick = function () {
    menuToggle.classList.toggle('menu-icon-active');
    mobileNavContainer.classList.toggle('mobile-nav-active');
  };

  function menuItemClick(item) {
    item.onclick = function () {
      menuToggle.classList.remove('menu-icon-active');
      mobileNavContainer.classList.remove('mobile-nav-active');
    };

  }

  for (let i = 0; i < menuItems.length; i++) {
    menuItemClick(menuItems[i]);
  }


  // ----------------------------------скрол якорные ссылки

  $('.go-anchor').on('click', function (event) {
    event.preventDefault();

    let sc = $(this).attr("href"),
      dn = $(sc).offset().top;


    $('html, body').animate({
      scrollTop: dn
    }, 1000);

  });




  //-----------------------------------------------------иконки элементов формы меняют цвет, когда в заполнен текст. 
  //----------------------------------------------------- также сохранение placeholder при вводе пробелов
  const formElements = document.querySelectorAll('.form-element');

  function formElementBlur(item) {
    item.onblur = function () {
      let icon = item.nextElementSibling;
      if (item.value.trim() !== '') {
        icon.classList.add('icon-has-text');
      } else {
        icon.classList.remove('icon-has-text');
        item.value = '';
      }


    };

  }

  for (let i = 0; i < formElements.length; i++) {
    formElementBlur(formElements[i]);
  }

  //---------------------------------------------------- add selects in form

  let newSetTemplate = document.querySelector('#new-set-template').content;
  let newSet = newSetTemplate.querySelector('.selects-box');

  let homeSelectsWrapper = document.querySelector('#homeSelectsWrapper');
  let childrenHomeWrapper = homeSelectsWrapper.children;
  let addSetHome = document.querySelector('#addSetHome');
  let homeFormBox = document.querySelector('#homeFormBox');


  let offerSelectsWrapper = document.querySelector('#offerSelectsWrapper');
  let childrenOfferWrapper = offerSelectsWrapper.children;
  let addSetOffer = document.querySelector('#addSetOffer');
  let offerFormBox = document.querySelector('#offerFormBox');
  let offerFormHeading = document.querySelector('#offerFormHeading');




  addSetHome.addEventListener('click', function () {
    let clonedNewSet = newSet.cloneNode(true);
    let formSetList = clonedNewSet.querySelector('.form-set-list');
    let selectAmount = clonedNewSet.querySelector('.select-amount');

    if (childrenHomeWrapper.length === 1) {
      formSetList.setAttribute('name', 'offerSetSecond');
      selectAmount.setAttribute('name', 'offerAmountSecond');
      homeFormBox.classList.add('several-sets');

      homeSelectsWrapper.append(clonedNewSet);

    } else if (childrenHomeWrapper.length === 2) {
      formSetList.setAttribute('name', 'offerSetThird');
      selectAmount.setAttribute('name', 'offerAmountThird');
      clonedNewSet.classList.add('last-set');
      homeSelectsWrapper.append(clonedNewSet);


    }

    if (childrenHomeWrapper.length === 3) {
      addSetHome.style.display = "none";
    }





  });

  addSetOffer.addEventListener('click', function () {
    let clonedNewSet = newSet.cloneNode(true);
    let formSetList = clonedNewSet.querySelector('.form-set-list');
    let selectAmount = clonedNewSet.querySelector('.select-amount');
    formSetList.classList.add('offer-select-set');

    if (childrenOfferWrapper.length === 1) {
      formSetList.setAttribute('name', 'offerSetSecond');
      selectAmount.setAttribute('name', 'offerAmountSecond');
      offerFormBox.classList.add('offer-several-sets');
      offerFormHeading.classList.add('offer-heading-several-sets');

      offerSelectsWrapper.append(clonedNewSet);

    } else if (childrenOfferWrapper.length === 2) {
      formSetList.setAttribute('name', 'offerSetThird');
      selectAmount.setAttribute('name', 'offerAmountThird');
      clonedNewSet.classList.add('last-set');
      offerSelectsWrapper.append(clonedNewSet);


    }

    if (childrenOfferWrapper.length === 3) {
      addSetOffer.style.display = "none";
    }





  });

  //=--------------------------------------------------- offer buttons click

  let orderButtonFirst = document.querySelector('#orderButtonFirst');
  let orderButtonSecond = document.querySelector('#orderButtonSecond');
  let orderButtonThird = document.querySelector('#orderButtonThird');
  let orderButtonFourth = document.querySelector('#orderButtonFourth');

  let offerSelectSet = document.querySelector('#offerSelectSet');
  let offerSelectAmount = document.querySelector('#offerSelectAmount');

  let firstCardSelect = document.querySelector('#firstCardSelect');
  let secondCardSelect = document.querySelector('#secondCardSelect');
  let thirdCardSelect = document.querySelector('#thirdCardSelect');
  let fourthCardSelect = document.querySelector('#fourthCardSelect');





  orderButtonFirst.addEventListener('click', function () {
    offerSelectSet.value = 'Полив 25';
    offerSelectAmount.value = firstCardSelect.value

  });

  orderButtonSecond.addEventListener('click', function () {
    offerSelectSet.value = 'Полив 50';
    offerSelectAmount.value = secondCardSelect.value

  });

  orderButtonThird.addEventListener('click', function () {
    offerSelectSet.value = 'Полив 100';
    offerSelectAmount.value = thirdCardSelect.value

  });

  orderButtonFourth.addEventListener('click', function () {
    offerSelectSet.value = 'Полив 500';
    offerSelectAmount.value = fourthCardSelect.value

  });


  //----------------------------------------------------------- stock buttons click

  let stockButtonFirst = document.querySelector('#stockButtonFirst');
  let stockButtonSecond = document.querySelector('#stockButtonSecond');

  stockButtonFirst.addEventListener('click', function () {

    if (childrenOfferWrapper.length === 2) {

    }

    offerSelectSet.value = 'Полив 50';
    offerSelectAmount.value = 1;


    let clonedNewSet = newSet.cloneNode(true);
    let formSetList = clonedNewSet.querySelector('.form-set-list');
    let selectAmount = clonedNewSet.querySelector('.select-amount');
    formSetList.classList.add('offer-select-set');

    formSetList.setAttribute('name', 'offerSetSecond');
    formSetList.value = 'Полив 100';
    selectAmount.setAttribute('name', 'offerAmountSecond');
    selectAmount.value = 1;

    clonedNewSet.classList.add('last-set');

    offerSelectsWrapper.append(clonedNewSet);

    addSetOffer.style.display = "none";



  });

  stockButtonSecond.addEventListener('click', function () {
    offerSelectSet.value = 'Полив 100';
    offerSelectAmount.value = 1;


    let clonedNewSet = newSet.cloneNode(true);
    let formSetList = clonedNewSet.querySelector('.form-set-list');
    let selectAmount = clonedNewSet.querySelector('.select-amount');
    formSetList.classList.add('offer-select-set');

    formSetList.setAttribute('name', 'offerSetSecond');
    formSetList.value = 'Полив 100';
    selectAmount.setAttribute('name', 'offerAmountSecond');
    selectAmount.value = 1;

    clonedNewSet.classList.add('last-set');

    offerSelectsWrapper.append(clonedNewSet);

    addSetOffer.style.display = "none";



  });

  let offerFormCross = document.querySelector('#offerFormCross');

  offerFormCross.addEventListener('click', function () {

    setTimeout(function () {
      addSetOffer.style.display = "inline-block";
      offerSelectSet.removeAttribute('disabled');
      offerSelectAmount.removeAttribute('disabled');
      offerFormBox.classList.remove('offer-several-sets');
      offerFormHeading.classList.remove('offer-heading-several-sets');

      while (childrenOfferWrapper.length > 1) {
        childrenOfferWrapper[childrenOfferWrapper.length - 1].remove();
      }

    }, 1000);

  });



  // ===================send question form==============================


  const questionsForm = document.querySelector('#questionsForm');
  const message = document.querySelector('#message');
  const messageText = document.querySelector('.message-text');
  const messageCross = document.querySelector('#messageCross');

  messageCross.onclick = function () {
    message.classList.remove('message-active');
  };


  function makeNotification(textString) {
    messageText.innerHTML = textString;
    message.classList.add('message-active');
    setTimeout(function () {
      message.classList.remove('message-active');
    }, 4000);
  }

  $('#questionsForm').trigger('reset');
  $(function () {
    'use strict';
    $('#questionsForm').on('submit', function (e) {
      e.preventDefault();
      $.ajax({
        url: $(this).attr('action'),
        type: 'POST',
        contentType: false,
        processData: false,
        data: new FormData(this),
        success: function (msg) {
          if (msg == 'ok') {
            $('#questionsForm').trigger('reset'); // очистка формы
            messageText.textContent = 'Сообщение отправлено';
            message.classList.add('message-active');
            setTimeout(function () {
              message.classList.remove('message-active');
            }, 4000);

          } else {
            messageText.textContent = msg;
            message.classList.add('message-active');
            setTimeout(function () {
              message.classList.remove('message-active');
            }, 4000);
          }
        }
      });
    });
  });

  // -----------------------------------------------------adding photo in the gallery


  const galleryDowlandInput = document.querySelector('#galleryDowlandInput');
  const fileNameElement = document.querySelector('#fileNameElement');
  const fileSelectedWrapper = document.querySelector('.file-selected-wrapper');
  const galleryDowlandLabel = document.querySelector('#galleryDowlandLabel');
  const galleryForm = document.querySelector('#galleryForm');
  const galleryDowlandButton = document.querySelector('#galleryDowlandButton');


  galleryDowlandInput.onchange = function () {
    let fileName = galleryDowlandInput.files[0].name;
    let fileType = galleryDowlandInput.files[0].type;
    let fileSize = galleryDowlandInput.files[0].size;

    fileNameElement.textContent = fileName;
    galleryDowlandLabel.style.display = 'none';
     fileSelectedWrapper.classList.add('selected-wrapper-active');

    if ((fileType === 'image/jpeg' || fileType === 'image/png') && fileSize <= 2000000) {
      galleryDowlandButton.removeAttribute('disabled');
      galleryDowlandButton.classList.remove('gallery-button-disabled');
    } else {
      makeNotification('Допустимые форматы: png, jpg. <br> Допустимый размер файла: 2 Мб');
      galleryDowlandButton.setAttribute('disabled', true);
      galleryDowlandButton.classList.add('gallery-button-disabled');
    }


  };

  galleryForm.onsubmit = function (evt) {
    evt.preventDefault();
    $.ajax({
      url: $(this).attr('action'),
      type: 'POST',
      contentType: false,
      processData: false,
      data: new FormData(this),
      success: function (msg) {
        galleryDowlandLabel.style.display = 'flex';
        fileSelectedWrapper.classList.remove('selected-wrapper-active');
        $('#galleryForm').trigger('reset'); // очистка формы

        if (msg === 'ok') {
          makeNotification('Спасибо за ваше участие! Фото отправлено и будет размещено в ближайщее время.');
        } else {
          makeNotification(msg);
        }
      }
    }); 
  };







});