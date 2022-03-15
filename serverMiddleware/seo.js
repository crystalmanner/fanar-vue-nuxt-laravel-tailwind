const redirects = require("./301.json");

module.exports = function(req, res, next) {
  console.log(req.url);
  const redirect = redirects.find(r => r.old_url === req.url);
  if (redirect) {
    console.log(`redirect: ${redirect.old_url} => ${redirect.destination_url}`);
    res.writeHead(301, { Location: redirect.destination_url });
    res.end();
  } else {
    next();
  }
};
