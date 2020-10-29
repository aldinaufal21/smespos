/**
 * This file is for get all environment variable at public/environments/*.json
 */

window.$ = require('jquery');

// DIRTY WAY TO GET CONFIG JSON
const theAppEnvirontment = () => {
  let environmentVariables;
  let appEnv = process.env.MIX_APP_ENV;

  let environment = appEnv == "local" ? "local" : "production";

  $.ajax({
    url: `environments/${environment}.json`,
    async: false,
    method: 'get',
    dataType: 'json',
    success: (res) => {
      environmentVariables = res;
    }
  });
  return environmentVariables;
}

export default theAppEnvirontment()