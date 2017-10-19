@extends('welcome')
@section('content')
<!-- begin #home -->
<div id="home" class="content has-bg home">
    <!-- begin content-bg -->
    <div class="content-bg">
        <img src="storage/frontend/assets/img/home-bg.jpg" alt="Home" />
    </div>
    <!-- end content-bg -->
    <!-- begin container -->
    <div class="container explore-content">
        <div class="text-center"><a href="/"><img src="storage/frontend/assets/img/logo.png" alt="CryptShares" width="" height="100" /></a></div>
        <h2 class="text-center">Group Listings</h2>
            <table id="data-table_explore_group" class="table">
                <tr>
                    <th class="text-center">Group Image</th>
                    <th class="text-center">Group Name</th>
                    <th class="text-center">Group Type</th>
                    <th class="text-center">Group Owner</th>
                    <th class="text-center">No. of Member(s)</th>
                </tr>
                @foreach ($all_groups as $key => $group_details)
                <tr>
                    <td class="text-center">
                        @if(!empty($group_details['group_image']))
                            <img class="img-circle" src="{{url('upload/group_image/resize/'.$group_details['group_image'])}}" style="width: 50px; height: 40px;" alt="User profile picture" />
                        @else
                            <img class="img-circle" src="{{ url('/upload/group_image/default_group_image.png')}}" style="width: 50px; height: 40px;" alt="User profile picture">
                        @endif
                    </td>
                    <td class="text-center vertical-middle"><a href="/group/dashboard/{{base64_encode($group_details['id'])}}" @if($group_details['description'] != '') title="{{$group_details['description']}}" @endif>{{$group_details['group_name']}}</a></td>
                    <td class="text-center vertical-middle">{{$group_details['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                    <td class="text-center vertical-middle">{{$group_details['user_info']['first_name']}} {{$group_details['user_info']['last_name']}}</td>
                    
                    <td class="text-center vertical-middle">{{$group_details['total_member_of_group']}}</td>
                </tr>
                @endforeach
            </table>
            <div class="text-center"> {!! $all_groups->links('') !!} </div>
        </div>
    <!-- end container -->
</div>
<style type="text/css">
    .table>tbody>tr>td, .table>tbody>tr>th, .table>tfoot>tr>td, .table>tfoot>tr>th, .table>thead>tr>td, .table>thead>tr>th {
        border-top: 0px solid #ddd!important;
    }
</style>
<!-- end #home -->
@stop