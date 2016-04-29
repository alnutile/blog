var app = angular.module("search", ["LiveSearch"]);
app.controller("SearchController", function($scope, $http, $q, $window) {
    function trimString(title)
    {
      if(title.length > 60)
      {
        return title.substring(0, 57) + '....';
      }

      return title;
    }

    $scope.mySearch = "";

    $scope.mySearchCallback = function(params) {

      var defer = $q.defer();

      $http.get("/search?search=" + params.query)
        .then(function(response) {
          if(!response.data.data) {
            defer.resolve([]);
          }
            var results = response.data.data.map(function(post) {
              return {
                "id": post.id,
                "title": trimString(post.title)
              };
            });
            defer.resolve(results);

        })
        .catch(function(e) {
          console.log(e.message);
          defer.reject(e);
        });

        return defer.promise;
    };
});