@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="main-content-table">
    <section class="section">
        <div class="margin-content">
            <div class="container-sm">
                <div class="section-header">
                    <h1>Dashboard</h1>
                </div>
                <div class="section-body">
                    <div class="container-sm bg-white">
                     @if(Auth::user()->role == 'superadmin')
                        <div>
                            <canvas id="myChart"></canvas>
                        </div>
                      @else 
                      <div class="section-body text-center p-4">
                          <h3 class="text-center">Total Pendapatan Hari Ini : Rp {{ number_format($totalSalesToday, 0, ',', '.') }}</h3>
                      </div>
                      @endif
                    </div>
                </div>
            </section>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
  const ctx = document.getElementById('myChart');

  fetch('/chart-data')
    .then(response => response.json())
    .then(data => {
      new Chart(ctx, {
        type: 'bar',
        data: data,
        options: {
          scales: {
            y: {
              beginAtZero: true
            }
          }
        }
      });
    })
    .catch(error => console.error('Error:', error));
</script>
@endpush