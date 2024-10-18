@extends('backend.layout')

@section('title')
    {{ 'Coupon List' }}
@endsection

@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Product</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Product</li>
                    <li class="breadcrumb-item active">Product List</li>
                </ol>
            </nav>
        </div>

        <section class="section">

            <form action="">

                <div class="row">

                    <div style="width: 50%; margin: 50px 50px;">
                        <canvas id="barChart"></canvas>

                    </div>
                    <div class="col-2">
                        <label for="starting_date" class="form-label">
                            Duration:
                        </label>

                        <select name="duration" id="duration" class="form-control" type="submit">
                            <option value="daily">daily</option>
                            <option value="weekly">weekly</option>
                            <option value="monthly">monthly</option>
                            <option value="yearly">yearly</option>
                        </select>
                    </div>


                    <div class="row">
                        <div class="col-2">
                            <label for="starting_date" class="form-label">
                                From:
                            </label>
                            <input type="date" name="from" class="form-control" required>
                        </div>
                        <div class="col-2">
                            <label for="ending_date" class="form-label">
                                To:
                            </label>
                            <input type="date" name="to" class="form-control" required>
                        </div>
                    </div>
                </div>
                <br>

                <div class="col-2">
                    <button type="submit" class="btn btn-primary">Generate Report</button>
                </div>

            </form>

            @if (!empty($sales_data[0]))
                <br><br><br><br>
                <div class="wrapper">

                    <div class="center">
                        <h3>Sales Report From <b>{{ $_GET['from'] }} To {{ $_GET['to'] }}</b></h3>
                    </div>

                    <div class="head-content">

                        <table class="table table-bordered" cellpadding="0" cellspacing="0" width="100%">

                            <thead class="table-dark">
                                <th>Order Date</th>
                                <th>Order Amount</th>
                                <th>Customer ID </th>
                            </thead>

                            <tbody>
                                <?php $total = 0; ?>
                                @foreach ($sales_data as $sales)
                                    <tr>

                                        <td> {{ $sales->created_at }} </td>
                                        <td> {{ $sales->order_total }} </td>
                                        <td> {{ $sales->customer_id }} </td>
                                    </tr>
                                    <?php $total += $sales->order_total; ?>
                                @endforeach
                                <tr class="table-active">
                                    <td><b> Grand Total </b></td>
                                    <td colspan="2">
                                        <b>{{ $total }}</b>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
            @endif

        </section>
    </main>
    <script>
        var ctx = document.getElementById('barChart').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: @json($data['labels']),
                datasets: [{
                    label: 'Data',
                    data: @json($data['data']),
                    backgroundColor: 'rgba(75, 192, 192, 0.2)',
                    borderColor: 'rgba(75, 192, 192, 1)',
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    </script>

    {{-- <script>
        $("#duration").on('change', function() {
            console.log($(this).val())
            duration = $(this).val();

            $.ajax({
                url: "{{ url('/sales') }}",
                type: "get",
                data: {duration},
                success:function(){
                    $("#barChart").load;
                }
            })
        })
    </script> --}}
@endsection
