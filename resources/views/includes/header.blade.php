
    <ul class="nav" id="side-menu">
        <li>
            <a href="/dashboardManage"><i class="fa fa-fw fa-dashboard"></i> {{trans("dashboard/messages.Page_Name")}} </a>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.PROC_MANAGE")}} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/processTypesManage">{{trans("header.PROCS_KINDS")}}</a>
                </li>
               {{-- <li>
                    <a href="/processesManage">Processes</a>
                </li>--}}
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.TRANS_MANAGE")}} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/transactionTypesManage">{{trans("header.TRANS_KINDS")}}</a>
                </li>
                <li>
                    <a href="/tStatesManage">{{trans("header.TSTATE_MANAGE")}}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.ENTS_MANAGE")}} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/entityTypesManage">{{trans("header.ENTS_KINDS")}}</a>
                </li>
                <li>
                    <a href="/dynSearchManage">{{trans("header.DYN_SEARCH")}} NEW NEW</a>
                </li>
            </ul>
        </li>
		<li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.PSD_MANAGE")}} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/CausalLinksManage">{{trans("header.CAUSAL_LINKS")}}</a>
                </li>
                <li>
                    <a href="/WaitingLinksManage">{{trans("header.WAIT_LINKS")}}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.ACTION_MANAGE")}} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/actionRulesManage">{{trans("header.ACT_RULES")}}</a>
                </li>
                <li>
                    <a href="/actionTemplatesManage">{{trans("header.ACT_TEMPLATES")}}</a>
                </li>
                <li>
                    <a href="/blocklytest">{{trans("header.BLOCKLY")}}</a>
                </li>
                <li>
                    <a href="/blocklynewpage">{{trans("header.BLOCKLY")}} New Page</a>
                </li>
            </ul>
        </li>
		<li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.PROP_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/">{{trans("header.ENT_PROP") }}</a>
                </li>
				<li>
					<a href="propAllowedValueManage">{{trans("header.ALLOWED_VALUES_MANAGE") }}</a>
				</li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.UNIT_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/propUnitTypeManage">{{trans("header.UNIT_KINDS") }} </a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.ACT_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/actorsManage">{{trans("header.ACTORS") }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.ROLS_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/rolesManage">{{trans("header.ROLS") }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.LANGS_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/languagesManage">{{trans("header.LANGS") }}</a>
                </li>
            </ul>
        </li>
        <li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.USERS_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/usersManage">{{trans("header.USERS") }}</a>
                </li>
            </ul>
        </li>
		<li>
            <a href="#"><i class="fa fa-fw fa-bar-chart-o"></i> {{trans("header.INTEGRATION_MANAGE") }} <i class="fa fa-fw fa-caret-down"></i></a>
            <ul class="nav nav-second-level">
                <li>
                    <a href="/systemIntegrationPropManage">{{trans("header.INTEGRATION_PROP") }}</a>
                </li>
                <li>
                    <a href="/systemIntegrationEntManage">{{trans("header.INTEGRATION_ENT_TYPE") }}</a>
                </li>
            </ul>
        </li>
    </ul>