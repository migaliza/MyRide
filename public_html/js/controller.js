/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$( document ).ready(function(){
    $(".button-collapse").sideNav();
    //$('#traffic').openModal();
    //$('#busStatus').closeModal();
});

 $(document).ready(function(){
    // the "href" attribute of .modal-trigger must specify the modal ID that wants to be triggered
    $('.modal-trigger').leanModal();
  });
  
  /**
   * function to add event on the collapsible menu in the Admindashboard
   */
 $(document).ready(function(){
    $('.collapsible').collapsible({
      //accordion : false // A setting that changes the collapsible behavior to expandable instead of the default accordion style
    });
  });