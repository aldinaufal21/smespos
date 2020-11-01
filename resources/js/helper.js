/**
 * 
 * 
 */

/**
 * 
 * @param {*} __formObject 
 * 
 * @return JSON
 */
window.serializeObject = (formObject) => {
  let __formObject = formObject;
  
  let result = {};
  $.each(__formObject.serializeArray(), function() {
      result[this.name] = this.value;
  });

  return result;
}