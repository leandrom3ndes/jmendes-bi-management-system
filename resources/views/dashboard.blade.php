@extends('layouts.default')
@section('page_name')
    {{trans("dashboard/messages.Page_Name")}}
@stop
@section('content')
    <div ng-controller="dashboardController">
        <div growl reference="80" inline="false">
        </div>
        <div id="iniciador">
        <div class="panel panel-green">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i>{{trans("dashboard/messages.TransactionsPanelName")}}</h3>
            </div>
            <div class="panel-body" ng-cloak>
                {{--<div class="col-lg-2 col-md-6" ng-repeat="transactiontype in ::transactiontypes_">
                <div class="panel panel-green">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-lg-12 text-center">
                                <h4>[[transactiontype.language[0].pivot.t_name]]</h4>
                            </div>
                        </div>
                    </div>
                        <div class="panel-footer text-center">
                            <button type="button" class="btn btn-md btn-default" ng-click="openModalTask('xl',transactiontype.id, transactiontype.init_proc, transactiontype.process_type_id)">{{trans("dashboard/messages.BTNTransactionPanel")}} <span><i class="fa fa-arrow-circle-right"></i></span></button>
                            <div class="clearfix"></div>
                        </div>
                </div>
                </div>--}}
                @foreach($transactions as $transaction)
                    <div class="col-lg-2 col-md-6">
                            @if ($transaction->is_del === false)
                                <div class="panel panel-green">
                            @else
                                <div class="panel panel-yellow">
                            @endif
                            <div class="panel-heading">
                                <div class="row">
                                      <div class="col-lg-12 text-center">
                                          <h4>{{$transaction->language[0]->pivot->t_name}}</h4>
                                      </div>
                                </div>
                            </div>
                            <div class="panel-footer text-center">
                                        <button type="button" class="btn btn-md btn-default" ng-click="identifyModalToOpen('{{$transaction->id}}', null, '{{$transaction->init_proc}}', null, null)">{{trans("dashboard/messages.BTNTransactionPanel")}} <span><i class="fa fa-arrow-circle-right"></i></span></button>
                                        <div class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
        </div>

        <div class="panel panel-info">
            <div class="panel-heading">
                <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> {{trans("dashboard/messages.ExistingInicTransactionsPanelName")}}</h3>
            </div>
            <div class="panel-body" ng-cloak>
                <div class="alert alert-danger" ng-show="tableParamsInicTrans==null">
                    {{trans("dashboard/messages.EMPTY_TABLE_INIC_TRANS")}}
                </div>
                <div class="table-responsive">
                    <table ng-table="tableParamsInicTrans" class="table table-condensed table-bordered table-hover" ng-show="tableParamsInicTrans!=null">
                        <tr ng-repeat="transaction in $data">
                            <td sortable="'process_type_name'" filter="{process_type_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER1")}}'"> <!--Process Type-->
                                [[::transaction.process_type_name]]
                            </td>

                            <td sortable="'process_name'" filter="{process_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER2")}}'"> <!--Transaction Type-->
                                [[::transaction.process_name]]
                            </td>

                            <td sortable="'transaction_id'" filter="{transaction_id: 'number'}" data-title="'{{trans("dashboard/messages.THEADER3")}}'"> <!--ID-->
                                [[::transaction.transaction_id]]
                            </td>

                            <td sortable="'t_name'" filter="{t_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER4")}}'"> <!--Entity Type-->
                                [[::transaction.t_name]]
                            </td>

                            <td sortable="'t_state_name'" filter="{t_state_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER5")}}'"> <!--Transaction State-->
                                [[::transaction.action.name]]
                                <span ng-if="isString(transaction.action)">
                                      [[::transaction.action]]
                                </span>
                                <div class="progress progress-sm active" ng-switch on="transaction.action_state">
                                    <div class="progress-bar progress-bar-danger progress-bar-striped"
                                         ng-switch-when="to_do"
                                         role="progressbar"
                                         aria-valuenow="100"
                                         aria-valuemin="0" aria-valuemax="100"
                                         ng-style="{ 'width' : '100%'}">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                    <div class="progress-bar progress-bar-warning progress-bar-striped"
                                         ng-switch-when="doing"
                                         role="progressbar"
                                         aria-valuenow="100"
                                         aria-valuemin="0" aria-valuemax="100"
                                         ng-style="{ 'width' : '100%'}">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                    <div class="progress-bar progress-bar-success progress-bar-striped"
                                         ng-switch-when="done"
                                         role="progressbar"
                                         aria-valuenow="100"
                                         aria-valuemin="0" aria-valuemax="100"
                                         ng-style="{ 'width' : '100%'}">
                                        <span class="sr-only">20% Complete</span>
                                    </div>
                                </div>
                            </td>

                            <td sortable="'created_at'" data-title="'{{trans("dashboard/messages.THEADER6")}}'">
                                [[::transaction.created_at ]]
                            </td>

                            {{--<td sortable="'updated_at'" data-title="'Updated_at' | translate">
                                [[::transaction.updated_at ]]
                            </td>--}}

                            <td data-title="'{{trans("dashboard/messages.THEADER7")}}'"> <!--Transaction State-->
                                [[::transaction.Type]]
                            </td>

                            <td>
                                <button type="button" class="btn btn-sm btn-success" ng-click="openModalContinueTransaction('lg',transaction.transaction_id, transaction.Type)">{{trans("dashboard/messages.THEADER8")}}</button>
                            </td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title"><i class="fa fa-clock-o fa-fw"></i> {{trans("dashboard/messages.CompletedTransactionsPanelName")}}</h3>
                </div>
                <div class="panel-body" ng-cloak>
                    <div class="alert alert-danger" ng-show="tableParamsCompletedTrans==null">
                        {{trans("dashboard/messages.EMPTY_TABLE_COMPLETED_TRANS")}}
                    </div>
                    <div class="table-responsive">
                        <table ng-table="tableParamsCompletedTrans" class="table table-condensed table-bordered table-hover" ng-show="tableParamsCompletedTrans!=null">
                            <tr ng-repeat="transaction in $data">
                                <td sortable="'process_type_name'" filter="{process_type_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER1")}}'"> <!--Process Type-->
                                    [[::transaction.process_type_name]]
                                </td>

                                <td sortable="'process_name'" filter="{process_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER2")}}'"> <!--Transaction Type-->
                                    [[::transaction.process_name]]
                                </td>

                                <td sortable="'transaction_id'" filter="{transaction_id: 'number'}" data-title="'{{trans("dashboard/messages.THEADER3")}}'"> <!--ID-->
                                    [[::transaction.transaction_id]]
                                </td>

                                <td sortable="'t_name'" filter="{t_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER4")}}'"> <!--Entity Type-->
                                    [[::transaction.t_name]]
                                </td>

                                <td sortable="'t_state_name'" filter="{t_state_name: 'text'}" data-title="'{{trans("dashboard/messages.THEADER5")}}'"> <!--Transaction State-->
                                    <div class="progress progress-sm active">
                                        <div class="progress-bar progress-bar-success progress-bar-striped"
                                             role="progressbar"
                                             aria-valuenow="100"
                                             aria-valuemin="0" aria-valuemax="100"
                                             ng-style="{ 'width' : '100%'}">
                                            <span class="sr-only">20% Complete</span>
                                        </div>
                                    </div>
                                </td>

                                <td sortable="'created_at'" data-title="'{{trans("dashboard/messages.THEADER6")}}'">
                                    [[::transaction.created_at ]]
                                </td>

                                {{--<td sortable="'updated_at'" data-title="'Updated_at' | translate">
                                    [[::transaction.updated_at ]]
                                </td>--}}

                                <td data-title="'{{trans("dashboard/messages.THEADER7")}}'"> <!--Transaction State-->
                                    [[::transaction.Type]]
                                </td>

                                <td>
                                    <button type="button" class="btn btn-sm btn-success" ng-click="openModalContinueTransaction('lg',transaction.transaction_id, transaction.Type)">{{trans("dashboard/messages.THEADER8")}}</button>
                                </td>
                            </tr>
                        </table>
                    </div>
                    {{-- <div class="text-right">
                         <a href="#">View All Activity <i class="fa fa-arrow-circle-right"></i></a>
                     </div>--}}
                </div>
        </div>
@stop
@section('footerContent')
    <script src="<?= asset('../js/app.js') ?>"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js" integrity="sha384-NaWTHo/8YCBYJ59830LTz/P4aQZK1sS0SneOgAvhsIl3zBu8r9RevNg5lHCHAuQ/" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script> <!--teste imagens-->
    <script>
        @if(Auth::check())
        // The user is logged in...
        var all = window.Echo.private('user.{{Auth::user()->id}}')
            .listen('TransactionEvent', (e) => {
                callAll();
            });

        console.log(all.subscription);
        @endif

        function callAll()
        {
            var $element = $('div[ng-controller="dashboardController"]');
            var scope = angular.element($element).scope();
            scope.getAllInicExecTrans();
            scope.addGrowl();
            console.log(scope);
        }
    </script>

    <script type="text/javascript">
        $(document).ready(function () {
            //YOUR JQUERY CODE
            function evenpanels() {
                var heights = [];                           // make an array
                $("#iniciador .panel.panel-green .panel-body .col-lg-2.col-md-6 .panel.panel-green .panel-heading").each(function(){           // copy the height of each
                    heights.push($(this).height());         //   element to the array
                });
                heights.sort(function(a, b){return b - a}); // sort the array high to low
                var minh = heights[0];                      // take the highest number
                $("#iniciador .panel.panel-green .panel-body .col-lg-2.col-md-6 .panel.panel-green .panel-heading").height(minh);              // and apply that to each element
            }

            $(window).on("resize", function (e) {
                $("#iniciador .panel.panel-green .panel-body .col-lg-2.col-md-6 .panel.panel-green .panel-heading").each(function(){
                    $(this).css('height',"");           // clear height values
                });
                evenpanels();
            }).resize();
        });
    </script>

    <script src="<?= asset('app/controllers/dashboard.js') ?>"></script>
@stop