<!DOCTYPE html>
<html lang="en">

<head>
  <title> Top Marks | @isset($SiteOption) {{ $SiteOption[0]->value }} @endisset</title>

  <!-- ======= Header ======= -->
  @include('layouts.frontHeader')
  <!-- End Header -->
  <!-- ======= Hero Section ======= -->
  <section id="hero" class="hero d-flex align-items-center section-bg">
    <div class="container">
      <!-- DataTales Example -->
    <div class="card shadow mb-4">
      <div class="card-header py-3">
          <h3 class="m-0 font-weight-bold text-primary">Top Position on Total Marks </h3>
      </div>
      <div class="card-body">
          <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                  <thead>
                      <tr>
                          <th>Position</th>
                          <th>Name</th>
                          <th>Total Marks</th>
                      </tr>
                  </thead>
                  <tfoot>
                      <tr>
                          <th>Position</th>
                          <th>Name</th>
                          <th>Total Marks</th>
                      </tr>
                  </tfoot>
                  <tbody>
                    @php $i=0 @endphp
                    @foreach ($data as $mark)
                    <tr>
                      <td>{{ $i+1 }}</td>
                      <td>{{ $mark->user->name }}</td>
                      <td>{{ $mark->total }}</td>
                    </tr>
                    @php $i++ @endphp
                    @endforeach
                  </tbody>
              </table>
          </div>
      </div>
      
  </div>
  <div class="card shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Top Marks By Set </h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <tbody>
                  @php $i=0 @endphp
                  @foreach ($setData as $set)
                  <tr>
                    <td>{{ $i+1 }}</td>
                    <td><a href="{{ route('marksSetHome',$set->id) }}">{{ $set->title}}</a></td>
                  </tr>
                  @php $i++ @endphp
                  @endforeach
                </tbody>
            </table>
        </div>
    </div>
    
</div>
    </div>
  </section><!-- End Hero Section -->
  <!-- ======= Footer ======= -->
  @include('layouts.frontFooter')
  <!-- End Footer -->
