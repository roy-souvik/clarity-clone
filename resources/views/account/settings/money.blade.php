@extends('layouts.inner')

@section('content')

@endsection

<section class="innerpage">

  <div class="container">

    <div class="dashinner">
      <div class="tabouter1">

        <!-- Nav tabs -->
        <ul class="nav nav-tabs" role="tablist">
          <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab">Earned</a></li>
          <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab">Paid</a></li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
          <div role="tabpanel" class="tab-pane active" id="home">

      <div class="row">
      <div class="col-sm-4 transactions">
      <h6>Account Balance</h6>

      <div class="boxpart">

        <div style="position:relative; margin-bottom:15px;"><span class="money"><input type="text" disabled="" value="0.00"  placeholder="$0.00" name="payout" class=" form-control"></span></div>

        <button type="button" disabled class="btn btn-success btn-block">Export to PayPal</button>
      </div>

          <div class="bottext"><strong>Total earned on Clarity: <span>$0.00</span></strong><br>
              Since you signed up on May 12, 2016
          </div>

      </div>

        <div class="col-sm-8">

          <h6>Transactions</h6>
          <div class="no-transactions"> There are no transactions yet. </div>

        </div>

      </div>


          </div>

        <div role="tabpanel" class="tab-pane" id="profile">

            <div class="row">
                <div class="col-sm-4 transactions">
                  <h6>Total Payments Made</h6>

                  <div class="boxpart">
                    <div style="position:relative; margin-bottom:15px;"><span class="money"><input type="text" disabled="" value="0.00"  placeholder="$0.00" name="payout" class=" form-control"></span></div>

                    <div class="adddate"><strong>As of July 2016</strong></div>
                  </div>

                </div>

                <div class="col-sm-8">
                  <h6>Transactions</h6>
                  <div class="no-transactions"> There are no transactions yet. </div>
                </div>

            </div>


        </div>

        </div>
      </div>
    </div>
  </div>
</section>    
