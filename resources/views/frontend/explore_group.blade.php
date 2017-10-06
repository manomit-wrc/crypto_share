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
        <h1>Group Listings</h1>
        <br>
            <table id="data-table" class="table table-hover">
                <tr>
                    <th class="text-center">Sr. No.</th>
                    <th class="text-center">Group Name</th>
                    <th class="text-center">Group Type</th>
                    <th class="text-center">Group Owner</th>
                    <th class="text-center">Owner Image</th>
                    <th class="text-center">No. of Member(s)</th>
                </tr>
                <?php $i = 1; ?>
                @foreach ($all_groups as $group_details)
                <tr>
                    <td class="text-center vertical-middle">{{$i}}</td>
                    <td class="text-center vertical-middle"><a href="/group/dashboard/{{base64_encode($group_details['id'])}}">{{$group_details['group_name']}}</a></td>
                    <td class="text-center vertical-middle">{{$group_details['group_type'] == 'cg' ? 'Close Group' : 'Open Group'}}</td>
                    <td class="text-center vertical-middle">{{$group_details['user_info']['first_name']}} {{$group_details['user_info']['last_name']}}</td>
                    <td class="text-center">
                        @if(!empty($group_details['user_info']['image']))
                            <img src="{{url('upload/profile_image/resize/'.$group_details['user_info']['image'])}}" style="width: 50px; height: 40px;" alt="User profile picture" />
                        @else
                            <img src="{{ url('/upload/profile_image/default.png')}}" style="width: 50px; height: 50px;" alt="User profile picture">
                        @endif
                    </td>
                    <td class="text-center vertical-middle">{{$group_details['total_member_of_group']}}</td>
                </tr>
                <?php $i++; ?>
                @endforeach
            </table>
            <div class="text-center"> {!! $all_groups->links('') !!} </div>
        </div>
    <!-- end container -->
</div>
<!-- end #home -->
@stop