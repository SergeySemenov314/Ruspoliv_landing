$(document).ready(function () {

        const addingGoodCross = document.querySelector('#addingGoodCross');
        const addingGood = document.querySelector('#addingGood');
        const addingGoodText = document.querySelector('.adding-good-text');

        addingGoodCross.onclick = function () {
            addingGood.classList.remove('adding-good-active');
        };

        $('.form-additional-good').trigger('reset');
        $(function () {
          'use strict';
          $('.form-additional-good').on('submit', function (e) {
            e.preventDefault();
            $.ajax({
              url: $(this).attr('action'),
              type: 'POST',
              contentType: false,
              processData: false,
              data: new FormData(this),
              success: function (msg) {
                console.log(msg);
                if (msg == 'ok') {
                  addingGoodText.textContent = 'Товар добавлен';
                  addingGood.classList.add('adding-good-active');
                  setTimeout(function () {
                      addingGood.classList.remove('adding-good-active');
                  }, 4000);
                  $('.form-additional-good').trigger('reset'); // очистка формы
                } else {
                  addingGoodText.textContent = msg;
                  addingGood.classList.add('adding-good-active');
                  setTimeout(function () {
                      addingGood.classList.remove('adding-good-active');
                  }, 4000);
                }
              }
            });
          });
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
      
      





});