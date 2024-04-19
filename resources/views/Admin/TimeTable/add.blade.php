@extends('Admin.layout.app')
@section('css')
    <style>

    </style>
@endsection
@section('title')
    <div class="page-header">
        <div class="row">
            <div class="col-sm-12">
                <div class="page-sub-header">
                    <h3 class="page-title">Time Table</h3>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="#">Time Table</a></li>
                        <li class="breadcrumb-item active">Time Table</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('content')
    <div class="row" id="add">
        <div class="col-sm-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('admin.time-tabletime') }}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <input type="text" class="form-control" id="subject" name="sub" required>
                        </div>

                        <div class="form-group">
                            <label for="date">Date</label>
                            <input type="date" class="form-control" id="date" name="date" required>
                        </div>

                        <div class="form-group">
                            <label for="time">Time</label>
                            <input type="time" class="form-control" id="time" name="time" required>
                        </div>

                        <div class="form-group">
                            <label for="day">Day</label>
                            <input type="text" class="form-control" id="day" name="day" required>
                        </div>

                        <button type="submit" class="btn btn-primary">Submit</button>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <div id="monu"></div>
@endsection
@section('js')
    <script>
        var data = {!! json_encode($timeTables) !!};
        var html;
        data.forEach(element => {
            // Accessing properties of each element in the loop
            html = `

            ID: ${element.id} , Date:${element.date}, Subject: ${element.sub}

            <main>
        <div class="container-fluid mb-5">

      <!-- Section: Basic examples -->
      <section>
        <h3>Time Table <span class="badge badge-pill badge-warning">EMILE</span></h3>
	    <p>Simple time-table component</p>
         <!-- Gird column -->
        <div class="col-md-12">
          <div class="card">
            <h2 class="my-4 dark-grey-text text-center "><i class=" fas fa-table"></i> Session : 80/41</h2>
            <div class="card-body">
              <div class="container">
                <div class="timetable-img text-center">
                    <img src="img/content/timetable.png" alt="">
                </div>
                <div class="table-responsive">
                    <table class="table table-striped" >
                        <thead>
                            <tr class="bg-light-gray">
                                <th><h5 class="my-1 dark-grey-text ">Times <i class="fas fa-arrow-down"></i> / Days <i class="fas fa-arrow-right"></i></h5></th>
                                @foreach ($timeTables as $day)
                                <th><h5 class="my-1 dark-grey-text ">{{ $day->day }}</h5></th>
                                @endforeach
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($timeTables as $day)
                            <tr>
                                <td class="align-middle">{{ $day->date }} ddd</td>
                                <td>
                                    <span class="bg-sky padding-5px-tb padding-15px-lr border-radius-5 margin-10px-bottom  font-size16 xs-font-size13">{{ $day->sub }}</span>
                                    <br><span>Happy</span>
                                 </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            </div>
          </div>

        </div>
        <!-- Gird column -->
        <!-- Gird column -->

        <!-- Gird column -->
      </section>
      <!-- Section: Basic examples -->

    </div>
  </main>

            ` // Assuming 'id' is a property of each element
            // Perform other operations with element properties here
        });
        $('#monu').append(html);
    </script>
@endsection
