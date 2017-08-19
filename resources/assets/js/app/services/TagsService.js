var tagsService = angular.module('tagsServices', ['ngResource']);

tagsService.
    factory('TagsService', ['$resource',
        function($resource){
            return $resource('/tags/:tid', {}, {
                query: {
                    method:'GET',
                    headers: {
                        'Content-Type': 'application/json',
                        'Accept': 'application/json'
                    }
                }
            });
        }]);