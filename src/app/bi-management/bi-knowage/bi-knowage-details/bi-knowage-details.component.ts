import { Component, OnInit } from '@angular/core';
import { BiManagementApiService } from '../../../shared/rest-api/bi-management-api.service';
import { ActivatedRoute } from '@angular/router';
import { DomSanitizer } from '@angular/platform-browser';

declare const Sbi: any;
declare var $;

@Component({
    selector: 'app-bi-knowage-details',
    templateUrl: './bi-knowage-details.component.html',
    styleUrls: ['./bi-knowage-details.component.css']
})

export class BiKnowageDetailsComponent implements OnInit {
    biKnowageId: any;
    public biKnowageDetail: any = [];
    public biKnowageDetailModel: {
        id: number;
        name: string;
        description: string;
        preview: any;
        type: string;
        role: string;
        dataset_label: string;
        created_at: any;
    }[] = [];
    constructor(
        private biManagementApiService: BiManagementApiService,
        private route: ActivatedRoute,
        private domSanitizer: DomSanitizer
    ) { }

    ngOnInit() {
        this.biKnowageId = this.route.snapshot.params.biKnowageId;
        this.setKnowageBaseUrl();
        this.getBiKnowageDetailModel();
    }
    setKnowageBaseUrl() {
        Sbi.sdk.services.setBaseUrl({
            protocol: 'http'
            , host: 'localhost'
            , port: '8080'
            , contextPath: 'knowage'
            , controllerPath: 'servlet/AdapterHTTP'
        });
    }
    getBiKnowageDetailModel() {
        this.biManagementApiService.getBiKnowageDetail(this.biKnowageId).subscribe(data => {
            this.biKnowageDetail = data.biKnowageDetail;
            for (const i in this.biKnowageDetail) {
                this.biKnowageDetailModel.push({
                    id: this.biKnowageId,
                    name: this.biKnowageDetail[i].name,
                    description: this.biKnowageDetail[i].description,
                    preview: this.domSanitizer.bypassSecurityTrustResourceUrl(this.biKnowageDetail[i].preview),
                    type: this.biKnowageDetail[i].type,
                    role: this.biKnowageDetail[i].role,
                    dataset_label: this.biKnowageDetail[i].dataset_label,
                    created_at: this.biKnowageDetail[i].created_at
                });
            }
        });
    }

    getBiKnowageSdkDoc() {
        for (const i in this.biKnowageDetail) {
            Sbi.sdk.api.injectDocument({
                documentLabel: this.biKnowageDetail[i].label
                , documentName: this.biKnowageDetail[i].name
                , executionRole: this.biKnowageDetail[i].role
                , displayToolbar: this.biKnowageDetail[i].toolbar
                , canResetParameters: this.biKnowageDetail[i].parameters
                , displaySliders: this.biKnowageDetail[i].sliders
                , target: 'targetDiv'
                , iframe: {
                    style: 'border: 0px; height:100vh; width:100%;'
                }
                , useExtUI: true
            });
        }
    }
    getBiKnowageDataset() {
        Sbi.sdk.cors.api.executeDataSet({
            datasetLabel: this.biKnowageDetail[0].dataset_label
            /*, parameters: {
                par_year: 2011,
                par_family: 'Food'
            }*/
            , callbackOk(obj) {
                let str = '<thead><tr>';
                str += '<th>Id</th>';
                const fields = obj.metaData.fields;
                for (const fieldIndex in fields) {
                    if (fields[fieldIndex].hasOwnProperty('header')) {
                        str += '<th>' + fields[fieldIndex].header + '</th>';
                    }
                }
                str += '</tr></thead>';
                str += '<tbody>';

                const rows = obj.rows;
                for (const rowIndex in rows) {
                    str += '<tr>';
                    for (const colIndex in rows[rowIndex]) {
                        str += '<td>' + rows[rowIndex][colIndex] + '</td>';
                    }
                    str += '</tr>';
                }

                str += '</tbody>';
                document.getElementById('knowageDataset').innerHTML = str;
                $('#knowageDataset').DataTable( {
                    dom: '<"dtsp-verticalContainer"<"dtsp-verticalPanes"P>Q<"dtsp-dataTable"' +
                        '<\'row\'<\'col-sm-12 col-md-4\'l><\'col-sm-12 col-md-4\'B><\'col-sm-12 col-md-4\'f>>' +
                        '<\'row\'<\'col-sm-12\'tr>>' +
                        '<\'row\'<\'col-sm-12 col-md-5\'i><\'col-sm-12 col-md-7\'p>>' + '>>',
                    language: {
                        url: 'assets/i18n/pt.json'
                    },
                    deferRender: true,
                    scrollX: true,
                    pageLength: 10,
                    destroy: true,
                    searchPanes: {
                        columns: [2, 3, 4, 5],
                        dtOpts: {
                            select: {
                                style: 'multi'
                            }
                        },
                        cascadePanes: true
                    },
                    searchBuilder: {
                        orthogonal: {
                            display: 'filter'
                        },
                    },
                    select: {
                        style: 'multi'
                    },
                    buttons: [
                        {
                            extend: 'colvis',
                            text: '<i class="fa fa-columns"></i>',
                            columnText: 'texto',
                            collectionLayout: 'fixed two-column',
                            collectionTitle: 'Visibilidade das colunas',
                            titleAttr: 'Visibilidade da Coluna',
                            columnText: function ( dt, idx, title ) {
                                return (idx + 0) + '- ' + title;
                            },
                            columns: ':gt(0)'
                        },
                        {
                            extend: 'excelHtml5',
                            text: '<i class="fa fa-file-excel-o"></i>',
                            titleAttr: 'Excel',
                            autoFilter: true,
                            exportOptions: {
                                columns: ':visible',
                                orthogonal: 'export'
                            }
                        },
                        {
                            extend: 'print',
                            text: '<i class="fa fa-print"></i>',
                            exportOptions: {
                                columns: ':visible',
                                orthogonal: 'export'
                            }
                        }
                    ],
                } );
            }
        });
    }
}
