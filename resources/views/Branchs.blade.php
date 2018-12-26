@extends('layouts.index')


@section('ScriptContent')
    @if ($Permission["ShowData"])        

        <script type="text/javascript">
        $(function () {
        
        
                $('#jtableContainer').jtable({
                    title: '<i class="fa fa-group  " style="color: orange;" aria-hidden="true"></i>  @lang("messages.Branchs")',
                    paging: true,
                    pageSize: 10,
                    sorting: true,
                    defaultSorting: 'SOrder DESC',
                    columnResizable: true,
                    columnSelectable: true,
                    saveUserPreferences: true,
                    //openChildAsAccordion: true, //Enable this line to show child tabes as accordion style
                    actions: {
                        
                        listAction:   '{{url("/")}}/api/ListOfBranchs?_token={{ csrf_token() }}',
                        @if ($Permission["InsertData"])
                            createAction: '{{url("/")}}/api/CreateBranch?_token={{ csrf_token() }}', 
                        @endif
                        @if ($Permission["UpdateData"])
                             updateAction: '{{url("/")}}/api/UpdateBranch?_token={{ csrf_token() }}', 
                        @endif
                        
                        @if ($Permission["DeleteData"])
                           deleteAction: '{{url("/")}}/api/DeleteBranch?_token={{ csrf_token() }}'
                        @endif
                        
                        
                    }
                    ,@include('layouts.inc.JtableToolbar'),
                    fields: {
                        BID:{
                            key: true,
                            list:false
                        },
                        BName: {
                        
                            create:true,
                            title: '@lang("messages.Branchs")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.Branchs")"   class=" form-control validate[required]"   autocomplete="off"   name="BName"   value="' + data.record.BName + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.Branchs")"     class="form-control validate[required]"  autocomplete="off"   name="BName"     />';
                                    }
                                }  
                            },
                    Baddress: {
                            title: '@lang("messages.address")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.address")"   class=" form-control validate[required]"   autocomplete="off"   name="Baddress"   value="' + data.record.Baddress + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.address")"     class="form-control validate[required]"  autocomplete="off"   name="Baddress"     />';
                                    }
                                }  
                            },
                        BFB: {
                            title: '@lang("messages.BFB")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.BFB")"   class=" form-control validate[required]"   autocomplete="off"   name="BFB"   value="' + data.record.BFB + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.BFB")"     class="form-control validate[required]"  autocomplete="off"   name="BFB"     />';
                                    }
                                }  
                            },
                        BWhats: {
                            title: '@lang("messages.BWhats")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.BWhats")"   class=" form-control validate[required]"   autocomplete="off"   name="BWhats"   value="' + data.record.BWhats + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.BWhats")"     class="form-control validate[required]"  autocomplete="off"   name="BWhats"     />';
                                    }
                                }  
                            },
                        BMail: {
                            title: '@lang("messages.email")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.email")"   class=" form-control validate[required]"   autocomplete="off"   name="BMail"   value="' + data.record.BMail + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.email")"     class="form-control validate[required]"  autocomplete="off"   name="BMail"     />';
                                    }
                                }  
                            },
                        BWebSite: {
                            title: '@lang("messages.BWebSite")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.BWebSite")"   class=" form-control validate[required]"   autocomplete="off"   name="BWebSite"   value="' + data.record.BWebSite + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.BWebSite")"     class="form-control validate[required]"  autocomplete="off"   name="BWebSite"     />';
                                    }
                                }  
                            },
                        BFax: {
                        title: '@lang("messages.BFax")',
                        input: function (data) {
                                if (data.record) {
                                    return '<input type="text"  placeholder="@lang("messages.BFax")"   class=" form-control validate[required]"   autocomplete="off"   name="BFax"   value="' + data.record.BFax + '" />';
                                } else {
                                    return '<input type="text"  placeholder="@lang("messages.BFax")"     class="form-control validate[required]"  autocomplete="off"   name="BFax"     />';
                                }
                            }  
                        },
                        BPhones: {
                            title: '@lang("messages.phone")',
                            input: function (data) {
                                    if (data.record) {
                                        return '<input type="text"  placeholder="@lang("messages.phone")"   class=" form-control validate[required]"   autocomplete="off"   name="BPhones"   value="' + data.record.BPhones + '" />';
                                    } else {
                                        return '<input type="text"  placeholder="@lang("messages.phone")"     class="form-control validate[required]"  autocomplete="off"   name="BPhones"     />';
                                    }
                                }  
                            },
                        
                        SOrder: {
                                title:  '@lang("messages.SOrder")',
                                    visibility: 'visible',
                                    width: '10%',
                                input: function (data) {
                                        if (data.record) {
                                            return '<input type="number"  placeholder="@lang("messages.SOrder")"   class=" form-control validate[required]"   autocomplete="off"   name="SOrder"   value="' + data.record.SOrder + '" />';
                                        } else {
                                            return '<input type="number"  placeholder="@lang("messages.SOrder")"   class="form-control validate[required]"  autocomplete="off"   name="SOrder"     />';
                                        }
                                    }  
                            }, 
                    
                    }
                            
                    @include('layouts.inc.JtableEvent')

                });
        
                //Load student list from server
                $('#jtableContainer').jtable('load');
        
            });

        </script>
    @endif
@endsection
