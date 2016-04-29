<form class="form-search offset3" ng-app="search" ng-controller='SearchController'>
        <live-search id="search1"
                     live-search-callback="mySearchCallback"
                     live-search-item-template="<a href='/posts/{{result.id}}'>{{result.title}}</a>"
                     live-search-select="fullName"
                     live-search-max-result-size="100"
                     ng-model="title" ></live-search>
</form>
<br>