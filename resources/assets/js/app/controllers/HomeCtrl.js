angular.module('homeCtrl', []).controller('HomeCtrl', ['$scope', 'TagsService',
    function($scope, TagsService){
        $scope.init = function(id) {
            $scope.tag_id = id;

            TagsService.get({tid: $scope.tag_id}, function(data){
                console.log(data);
                $scope.tag = data.data;
                $scope.tagsAll = data.data.tagsAll;
                $scope.projects = data.data.projects;
                $scope.posts = data.data.posts;
            });

            $scope.summary = function(body) {
                var sub = String(body).replace(/<[^>]+>/gm, '');
                return sub.substr(0, 200);
            }
        };
    }]);