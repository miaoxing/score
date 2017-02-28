define(function () {
  var ScoreRecords = function () {
    // do nothing.
  };

  ScoreRecords.prototype.indexAction = function (options) {
    $.extend(this, options);
  };

  return new ScoreRecords();
});
