@extends('admin.layouts.main')
@push('customStyles')
{{-- Category Table Style --}}
<style type="text/css">
  #category-sales_filter>label,
  #category-sales>label {
    display: flex;
    align-items: center;
  }

  #category-sales_filter>label>input,
  #category-sales>label>input {
    width: 100%;
  }

  .filter-btn {
    width: 100%;
  }

  #paymenttotal{
    font-size: 28px;
  }
</style>
{{-- Chart JS --}}
<style type="text/css">
  /* Chart.js */
  @keyframes chartjs-render-animation {
    from {
      opacity: .99
    }

    to {
      opacity: 1
    }
  }

  .chartjs-render-monitor {
    animation: chartjs-render-animation 1ms
  }

  .chartjs-size-monitor,
  .chartjs-size-monitor-expand,
  .chartjs-size-monitor-shrink {
    position: absolute;
    direction: ltr;
    left: 0;
    top: 0;
    right: 0;
    bottom: 0;
    overflow: hidden;
    pointer-events: none;
    visibility: hidden;
    z-index: -1
  }

  .chartjs-size-monitor-expand>div {
    position: absolute;
    width: 1000000px;
    height: 1000000px;
    left: 0;
    top: 0
  }

  .chartjs-size-monitor-shrink>div {
    position: absolute;
    width: 200%;
    height: 200%;
    left: 0;
    top: 0
  }
</style>
{{-- Apex Charts --}}
<style type="text/css">
  .apexcharts-canvas {
    position: relative;
    user-select: none;
    /* cannot give overflow: hidden as it will crop tooltips which overflow outside chart area */
  }


  /* scrollbar is not visible by default for legend, hence forcing the visibility */
  .apexcharts-canvas ::-webkit-scrollbar {
    -webkit-appearance: none;
    width: 6px;
  }

  .apexcharts-canvas ::-webkit-scrollbar-thumb {
    border-radius: 4px;
    background-color: rgba(0, 0, 0, .5);
    box-shadow: 0 0 1px rgba(255, 255, 255, .5);
    -webkit-box-shadow: 0 0 1px rgba(255, 255, 255, .5);
  }


  .apexcharts-inner {
    position: relative;
  }

  .apexcharts-text tspan {
    font-family: inherit;
  }

  .legend-mouseover-inactive {
    transition: 0.15s ease all;
    opacity: 0.20;
  }

  .apexcharts-series-collapsed {
    opacity: 0;
  }

  .apexcharts-tooltip {
    border-radius: 5px;
    box-shadow: 2px 2px 6px -4px #999;
    cursor: default;
    font-size: 14px;
    left: 62px;
    opacity: 0;
    pointer-events: none;
    position: absolute;
    top: 20px;
    display: flex;
    flex-direction: column;
    overflow: hidden;
    white-space: nowrap;
    z-index: 12;
    transition: 0.15s ease all;
  }

  .apexcharts-tooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-tooltip.apexcharts-theme-light {
    border: 1px solid #e3e3e3;
    background: rgba(255, 255, 255, 0.96);
  }

  .apexcharts-tooltip.apexcharts-theme-dark {
    color: #fff;
    background: rgba(30, 30, 30, 0.8);
  }

  .apexcharts-tooltip * {
    font-family: inherit;
  }


  .apexcharts-tooltip-title {
    padding: 6px;
    font-size: 15px;
    margin-bottom: 4px;
  }

  .apexcharts-tooltip.apexcharts-theme-light .apexcharts-tooltip-title {
    background: #ECEFF1;
    border-bottom: 1px solid #ddd;
  }

  .apexcharts-tooltip.apexcharts-theme-dark .apexcharts-tooltip-title {
    background: rgba(0, 0, 0, 0.7);
    border-bottom: 1px solid #333;
  }

  .apexcharts-tooltip-text-value,
  .apexcharts-tooltip-text-z-value {
    display: inline-block;
    font-weight: 600;
    margin-left: 5px;
  }

  .apexcharts-tooltip-text-z-label:empty,
  .apexcharts-tooltip-text-z-value:empty {
    display: none;
  }

  .apexcharts-tooltip-text-value,
  .apexcharts-tooltip-text-z-value {
    font-weight: 600;
  }

  .apexcharts-tooltip-marker {
    width: 12px;
    height: 12px;
    position: relative;
    top: 0px;
    margin-right: 10px;
    border-radius: 50%;
  }

  .apexcharts-tooltip-series-group {
    padding: 0 10px;
    display: none;
    text-align: left;
    justify-content: left;
    align-items: center;
  }

  .apexcharts-tooltip-series-group.apexcharts-active .apexcharts-tooltip-marker {
    opacity: 1;
  }

  .apexcharts-tooltip-series-group.apexcharts-active,
  .apexcharts-tooltip-series-group:last-child {
    padding-bottom: 4px;
  }

  .apexcharts-tooltip-series-group-hidden {
    opacity: 0;
    height: 0;
    line-height: 0;
    padding: 0 !important;
  }

  .apexcharts-tooltip-y-group {
    padding: 6px 0 5px;
  }

  .apexcharts-tooltip-candlestick {
    padding: 4px 8px;
  }

  .apexcharts-tooltip-candlestick>div {
    margin: 4px 0;
  }

  .apexcharts-tooltip-candlestick span.value {
    font-weight: bold;
  }

  .apexcharts-tooltip-rangebar {
    padding: 5px 8px;
  }

  .apexcharts-tooltip-rangebar .category {
    font-weight: 600;
    color: #777;
  }

  .apexcharts-tooltip-rangebar .series-name {
    font-weight: bold;
    display: block;
    margin-bottom: 5px;
  }

  .apexcharts-xaxistooltip {
    opacity: 0;
    padding: 9px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
    transition: 0.15s ease all;
  }

  .apexcharts-xaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
  }

  .apexcharts-xaxistooltip:after,
  .apexcharts-xaxistooltip:before {
    left: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
  }

  .apexcharts-xaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-left: -6px;
  }

  .apexcharts-xaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-left: -7px;
  }

  .apexcharts-xaxistooltip-bottom:after,
  .apexcharts-xaxistooltip-bottom:before {
    bottom: 100%;
  }

  .apexcharts-xaxistooltip-top:after,
  .apexcharts-xaxistooltip-top:before {
    top: 100%;
  }

  .apexcharts-xaxistooltip-bottom:after {
    border-bottom-color: #ECEFF1;
  }

  .apexcharts-xaxistooltip-bottom:before {
    border-bottom-color: #90A4AE;
  }

  .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:after {
    border-bottom-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-bottom.apexcharts-theme-dark:before {
    border-bottom-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-top:after {
    border-top-color: #ECEFF1
  }

  .apexcharts-xaxistooltip-top:before {
    border-top-color: #90A4AE;
  }

  .apexcharts-xaxistooltip-top.apexcharts-theme-dark:after {
    border-top-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip-top.apexcharts-theme-dark:before {
    border-top-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-xaxistooltip.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-yaxistooltip {
    opacity: 0;
    padding: 4px 10px;
    pointer-events: none;
    color: #373d3f;
    font-size: 13px;
    text-align: center;
    border-radius: 2px;
    position: absolute;
    z-index: 10;
    background: #ECEFF1;
    border: 1px solid #90A4AE;
  }

  .apexcharts-yaxistooltip.apexcharts-theme-dark {
    background: rgba(0, 0, 0, 0.7);
    border: 1px solid rgba(0, 0, 0, 0.5);
    color: #fff;
  }

  .apexcharts-yaxistooltip:after,
  .apexcharts-yaxistooltip:before {
    top: 50%;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
  }

  .apexcharts-yaxistooltip:after {
    border-color: rgba(236, 239, 241, 0);
    border-width: 6px;
    margin-top: -6px;
  }

  .apexcharts-yaxistooltip:before {
    border-color: rgba(144, 164, 174, 0);
    border-width: 7px;
    margin-top: -7px;
  }

  .apexcharts-yaxistooltip-left:after,
  .apexcharts-yaxistooltip-left:before {
    left: 100%;
  }

  .apexcharts-yaxistooltip-right:after,
  .apexcharts-yaxistooltip-right:before {
    right: 100%;
  }

  .apexcharts-yaxistooltip-left:after {
    border-left-color: #ECEFF1;
  }

  .apexcharts-yaxistooltip-left:before {
    border-left-color: #90A4AE;
  }

  .apexcharts-yaxistooltip-left.apexcharts-theme-dark:after {
    border-left-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-left.apexcharts-theme-dark:before {
    border-left-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-right:after {
    border-right-color: #ECEFF1;
  }

  .apexcharts-yaxistooltip-right:before {
    border-right-color: #90A4AE;
  }

  .apexcharts-yaxistooltip-right.apexcharts-theme-dark:after {
    border-right-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip-right.apexcharts-theme-dark:before {
    border-right-color: rgba(0, 0, 0, 0.5);
  }

  .apexcharts-yaxistooltip.apexcharts-active {
    opacity: 1;
  }

  .apexcharts-yaxistooltip-hidden {
    display: none;
  }

  .apexcharts-xcrosshairs,
  .apexcharts-ycrosshairs {
    pointer-events: none;
    opacity: 0;
    transition: 0.15s ease all;
  }

  .apexcharts-xcrosshairs.apexcharts-active,
  .apexcharts-ycrosshairs.apexcharts-active {
    opacity: 1;
    transition: 0.15s ease all;
  }

  .apexcharts-ycrosshairs-hidden {
    opacity: 0;
  }

  .apexcharts-selection-rect {
    cursor: move;
  }

  .svg_select_boundingRect,
  .svg_select_points_rot {
    pointer-events: none;
    opacity: 0;
    visibility: hidden;
  }

  .apexcharts-selection-rect+g .svg_select_boundingRect,
  .apexcharts-selection-rect+g .svg_select_points_rot {
    opacity: 0;
    visibility: hidden;
  }

  .apexcharts-selection-rect+g .svg_select_points_l,
  .apexcharts-selection-rect+g .svg_select_points_r {
    cursor: ew-resize;
    opacity: 1;
    visibility: visible;
  }

  .svg_select_points {
    fill: #efefef;
    stroke: #333;
    rx: 2;
  }

  .apexcharts-svg.apexcharts-zoomable.hovering-zoom {
    cursor: crosshair
  }

  .apexcharts-svg.apexcharts-zoomable.hovering-pan {
    cursor: move
  }

  .apexcharts-zoom-icon,
  .apexcharts-zoomin-icon,
  .apexcharts-zoomout-icon,
  .apexcharts-reset-icon,
  .apexcharts-pan-icon,
  .apexcharts-selection-icon,
  .apexcharts-menu-icon,
  .apexcharts-toolbar-custom-icon {
    cursor: pointer;
    width: 20px;
    height: 20px;
    line-height: 24px;
    color: #6E8192;
    text-align: center;
  }

  .apexcharts-zoom-icon svg,
  .apexcharts-zoomin-icon svg,
  .apexcharts-zoomout-icon svg,
  .apexcharts-reset-icon svg,
  .apexcharts-menu-icon svg {
    fill: #6E8192;
  }

  .apexcharts-selection-icon svg {
    fill: #444;
    transform: scale(0.76)
  }

  .apexcharts-theme-dark .apexcharts-zoom-icon svg,
  .apexcharts-theme-dark .apexcharts-zoomin-icon svg,
  .apexcharts-theme-dark .apexcharts-zoomout-icon svg,
  .apexcharts-theme-dark .apexcharts-reset-icon svg,
  .apexcharts-theme-dark .apexcharts-pan-icon svg,
  .apexcharts-theme-dark .apexcharts-selection-icon svg,
  .apexcharts-theme-dark .apexcharts-menu-icon svg,
  .apexcharts-theme-dark .apexcharts-toolbar-custom-icon svg {
    fill: #f3f4f5;
  }

  .apexcharts-canvas .apexcharts-zoom-icon.apexcharts-selected svg,
  .apexcharts-canvas .apexcharts-selection-icon.apexcharts-selected svg,
  .apexcharts-canvas .apexcharts-reset-zoom-icon.apexcharts-selected svg {
    fill: #008FFB;
  }

  .apexcharts-theme-light .apexcharts-selection-icon:not(.apexcharts-selected):hover svg,
  .apexcharts-theme-light .apexcharts-zoom-icon:not(.apexcharts-selected):hover svg,
  .apexcharts-theme-light .apexcharts-zoomin-icon:hover svg,
  .apexcharts-theme-light .apexcharts-zoomout-icon:hover svg,
  .apexcharts-theme-light .apexcharts-reset-icon:hover svg,
  .apexcharts-theme-light .apexcharts-menu-icon:hover svg {
    fill: #333;
  }

  .apexcharts-selection-icon,
  .apexcharts-menu-icon {
    position: relative;
  }

  .apexcharts-reset-icon {
    margin-left: 5px;
  }

  .apexcharts-zoom-icon,
  .apexcharts-reset-icon,
  .apexcharts-menu-icon {
    transform: scale(0.85);
  }

  .apexcharts-zoomin-icon,
  .apexcharts-zoomout-icon {
    transform: scale(0.7)
  }

  .apexcharts-zoomout-icon {
    margin-right: 3px;
  }

  .apexcharts-pan-icon {
    transform: scale(0.62);
    position: relative;
    left: 1px;
    top: 0px;
  }

  .apexcharts-pan-icon svg {
    fill: #fff;
    stroke: #6E8192;
    stroke-width: 2;
  }

  .apexcharts-pan-icon.apexcharts-selected svg {
    stroke: #008FFB;
  }

  .apexcharts-pan-icon:not(.apexcharts-selected):hover svg {
    stroke: #333;
  }

  .apexcharts-toolbar {
    position: absolute;
    z-index: 11;
    max-width: 176px;
    text-align: right;
    border-radius: 3px;
    padding: 0px 6px 2px 6px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .apexcharts-menu {
    background: #fff;
    position: absolute;
    top: 100%;
    border: 1px solid #ddd;
    border-radius: 3px;
    padding: 3px;
    right: 10px;
    opacity: 0;
    min-width: 110px;
    transition: 0.15s ease all;
    pointer-events: none;
  }

  .apexcharts-menu.apexcharts-menu-open {
    opacity: 1;
    pointer-events: all;
    transition: 0.15s ease all;
  }

  .apexcharts-menu-item {
    padding: 6px 7px;
    font-size: 12px;
    cursor: pointer;
  }

  .apexcharts-theme-light .apexcharts-menu-item:hover {
    background: #eee;
  }

  .apexcharts-theme-dark .apexcharts-menu {
    background: rgba(0, 0, 0, 0.7);
    color: #fff;
  }

  @media screen and (min-width: 768px) {
    .apexcharts-canvas:hover .apexcharts-toolbar {
      opacity: 1;
    }
  }

  .apexcharts-datalabel.apexcharts-element-hidden {
    opacity: 0;
  }

  .apexcharts-pie-label,
  .apexcharts-datalabels,
  .apexcharts-datalabel,
  .apexcharts-datalabel-label,
  .apexcharts-datalabel-value {
    cursor: default;
    pointer-events: none;
  }

  .apexcharts-pie-label-delay {
    opacity: 0;
    animation-name: opaque;
    animation-duration: 0.3s;
    animation-fill-mode: forwards;
    animation-timing-function: ease;
  }

  .apexcharts-canvas .apexcharts-element-hidden {
    opacity: 0;
  }

  .apexcharts-hide .apexcharts-series-points {
    opacity: 0;
  }

  .apexcharts-gridline,
  .apexcharts-annotation-rect,
  .apexcharts-tooltip .apexcharts-marker,
  .apexcharts-area-series .apexcharts-area,
  .apexcharts-line,
  .apexcharts-zoom-rect,
  .apexcharts-toolbar svg,
  .apexcharts-area-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
  .apexcharts-line-series .apexcharts-series-markers .apexcharts-marker.no-pointer-events,
  .apexcharts-radar-series path,
  .apexcharts-radar-series polygon {
    pointer-events: none;
  }


  /* markers */

  .apexcharts-marker {
    transition: 0.15s ease all;
  }

  @keyframes opaque {
    0% {
      opacity: 0;
    }

    100% {
      opacity: 1;
    }
  }


  /* Resize generated styles */

  @keyframes resizeanim {
    from {
      opacity: 0;
    }

    to {
      opacity: 0;
    }
  }

  .resize-triggers {
    animation: 1ms resizeanim;
    visibility: hidden;
    opacity: 0;
  }

  .resize-triggers,
  .resize-triggers>div,
  .contract-trigger:before {
    content: " ";
    display: block;
    position: absolute;
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
    overflow: hidden;
  }

  .resize-triggers>div {
    background: #eee;
    overflow: auto;
  }

  .contract-trigger:before {
    width: 200%;
    height: 200%;
  }
</style>
@endpush
@section('container')
<!-- ============================================================== -->
<!-- Start right Content here -->
<!-- ============================================================== -->
<div class="row">

  <!-- start page title -->
  <div class="row">
    <div class="col-12">
      <div class="page-title-box d-sm-flex align-items-center justify-content-between">
        <h4 class="mb-sm-0 font-size-18">Dashboard</h4>
      </div>
    </div>
  </div>
  <div class="card-body">
    <div class="row">
      <div class="col-sm-4">
        <div class="col-sm-12">
          <button id="week" class="btn btn-primary w-md filter-btn">Week</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="col-sm-12">
          <button id="month" class="btn btn-success w-md filter-btn">Month</button>
        </div>
      </div>
      <div class="col-sm-4">
        <div class="col-sm-12">
          <button id="btn-custom" class="btn btn-danger w-md filter-btn">Custom</button>
        </div>
      </div>

    </div>
  </div>
  <div class="date-range" style="display: none">
    <div class="card">
      <div class="card-body">

        <div class="row">
          <div class="col-sm-4">
            <strong><label for="horizontal-name-input" class="col-sm-3 col-form-label">From</label></strong>
            <div class="col-sm-12">
              <input type="date" name="from_date" id="from_date" class="form-control">
            </div>
          </div>
          <div class="col-sm-4">
            <strong><label for="horizontal-heading_two-input" class="col-sm-3 col-form-label">To</label></strong>
            <div class="col-sm-12">
              <input type="date" name="to_date" id="to_date" class="form-control">
            </div>
          </div>
          <div class="col-sm-4" style="margin-top:3%">
            <div class="col-sm-12">
              <button id="filter" class="btn btn-primary w-md">Filter</button>
              <button id="refresh" class="btn btn-success w-md">Refresh</button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <!-- end page title -->
  <div class="row">
    <div class="col-xl-4">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title mb-4">Monthly Payments</h4>
          <div class="row">
            <div class="col-sm-6">
              <p class="text-muted">This month</p>

              <h3 id="paymenttotal"></h3>

              {{-- <p class="text-muted"><span class="text-success me-2"> 12% <i class="mdi mdi-arrow-up"></i> </span> From
                previous period</p> --}}
            </div>
            <div class="col-sm-6">
              <div class="mt-4 mt-sm-0">
                <div id="radialBar-chart" class="apex-charts"></div>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-body">
          <h4 class="card-title">Hot Categories</h4>
          <div class="row">
            <table id="category-sales" class="table table-striped yajra-datatable">
              <div class="row">
                <div class="col-sm-12">
                  <thead>
                    <tr>
                      <th>Category Name</th>
                      <th>Total Sales</th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
            </table>
          </div>
        </div>
      </div>


      {{-- <div>
        <div id="donut-chart" class="apex-charts"></div>
      </div> --}}
    </div>
    <div class="col-xl-8">
      <div class="row">
        <div class="col-md-4">
          <div class="card mini-stats-wid">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <p class="text-muted fw-medium">Orders</p>
                  <h4 class="mb-0" id="orders"></h4>
                </div>

                <div class="flex-shrink-0 align-self-center">
                  <div class="mini-stat-icon avatar-sm rounded-circle bg-primary">
                    <span class="avatar-title">
                      <i class="bx bx-copy-alt font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mini-stats-wid">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <p class="text-muted fw-medium">Revenue</p>
                  <h4 class="mb-0" id="revenue"></h4>
                </div>

                <div class="flex-shrink-0 align-self-center ">
                  <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-archive-in font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-md-4">
          <div class="card mini-stats-wid">
            <div class="card-body">
              <div class="d-flex">
                <div class="flex-grow-1">
                  <p class="text-muted fw-medium">Average Payments</p>
                  <h4 class="mb-0" id="averageprice"></h4>
                </div>

                <div class="flex-shrink-0 align-self-center">
                  <div class="avatar-sm rounded-circle bg-primary mini-stat-icon">
                    <span class="avatar-title rounded-circle bg-primary">
                      <i class="bx bx-purchase-tag-alt font-size-24"></i>
                    </span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <!-- end row -->

      <div class="card">
        <div class="card-body">
          <div class="row">
            <h4 class="card-title mb-4">Sales</h4>
            <p class="text-muted">Daily Payments against payment links</p>
            {{-- <div class="col-sm-12">
              <select class="form-control select2" id="Linecharts">
                <option value="" selected disabled>Select Payment Link Report</option>
                <option value="month">Monthly Wise Payments</option>
                <option value="year">Yearly Wise Payments</option>
              </select>
            </div> --}}
            <div class="col-lg-12">
              <div id="contenedor_chart">
                <canvas id="sales-chart" class="apex-charts" dir="ltr"> </canvas>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </div>

</div>


<div class="row">
  <div class="col-lg-12">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title mb-4">Latest Transaction</h4>
        <table id="payments" class="table table-striped yajra-datatable">
          <thead>
            <tr>
              <th>ID</th>
              <th>Name</th>
              <th>Date</th>
              <th>Price</th>
              <th>Payment Gateway</th>
              <th>Comment</th>
              <th>Status</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
</div>
<!-- end row -->
</div>

@endsection

@push('customScripts')
{{-- Apex Chart --}}
<script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
{{-- Chart JS --}}
<script src="{{ asset('backend/assets/libs/chart.js/Chart.bundle.min.js') }}"></script>
<script src="{{ asset('backend/assets/js/pages/chartjs.init.js') }}"></script>
<script>
  $(document).ready(function () {
          $('.select2').select2();
       });

       // Sales Chart
       function salesChart(data)
       {

            horizontal = [];
            verticle = [];
            verticle2 = [];


            $.each(data, function(i,item){

            horizontal.push(item.date);	//horiz

            if(item[0].total_orders==null) {
                verticle.push(0);	//verticle
            } else {
                verticle.push(item[0].total_orders);
            }

            if(item[0].total_sales==null) {
                verticle2.push(0);	//verticle
            } else {
                verticle2.push(item[0].total_sales);
            }

            });

            var labels_data = {labels:
                    horizontal,
                            datasets: [{
                                label: 'Orders',
                                data: verticle,
                                backgroundColor: 'rgba(0, 0, 0, 0)',
                                borderColor: 'rgba(0, 0, 0, 0.25)',
                                borderWidth: 2
                            }
                            ,
                            {
                                label: 'Amount',
                                data: verticle2,
                                backgroundColor: 'rgba(18, 17, 205, 0.12)',
                                borderColor: 'rgba(18, 17, 204, 0.8)',
                                borderWidth: 2
                            }
                        ]
                    };



            var options_data= {
                        responsive: true,
                        legend: {
                        position: 'top',
                        },
                        title: {
                        display: false,
                        text: 'Payments Chart'
                        },
                        animation: {
                        animateScale: true,
                        animateRotate: true
                        }

                    };


            chart_generator("contenedor_chart","sales-chart", "line", labels_data, options_data);

       }

        function chart_generator(appendTo, chart_id, chart_type, labels_data, options_data) {
            $('#'+appendTo).append();

            var ctx = $("#"+chart_id);
            var myChart = new Chart(ctx, {
                type: chart_type,
                data: labels_data,
                options: options_data
            });
        }
        // Donut charts

        // function donutChart(donutchartName, donutchartData, donutchartLabels, donutchartHeight, donutcanvasID) {
        //     if (typeof chart !== "undefined") {
        //         chart.destroy();
        //     }

        //     options = { series: donutchartData, name: donutchartName, chart: { type: "donut", height: donutchartHeight },
        //         labels: donutchartLabels, colors: ["#556ee6", "#34c38f", "#f46a6a"],
        //         legend: { show: !1 }, plotOptions: { pie: { donut: { size: "70%" } } }
        //     };
        //     (chart = new ApexCharts(document.querySelector(donutcanvasID), options)).render();

        // }

        //End  Donut charts


    // $(document).ready(function() {

        var date = new Date();
        $('.input-daterange').datepicker( {
            todayBtn: 'linked',
            format: 'yyyy-mm-dd',
            autoclose: true
        });

        var _token = $('input[name="_token"]').val();
        fetch_data();

        function fetch_data(from_date = '', to_date = '', week = '', month = '') {

            //donut charts
            // $.ajax({
            //     url:"{{ route('dateRange_DonutCharts_Apidata')}}",
            //     type:"post",
            //     data:{
            //         from_date:from_date, to_date:to_date,week:week,month:month,_token:_token
            //     },
            //     success:function(data) {

            //         var categories = [];
            //         var labels = [];
            //         for (var i in data) {
            //             categories.push(data[i].total_category);
            //             labels.push(data[i].name);

            //         }
            //         donutChart("categories", categories, labels, 262, "#donut-chart");

            //     }

            // })


            // orders
            $.ajax({
                url: route('dateRange_Orders'),
                type: "post",
                data: {from_date:from_date, to_date:to_date,week:week,month:month,_token:_token},
                success: function (data) {
                    $('#orders').html(data);

                }
            });

            // revenue
            $.ajax({
                url: route('dateRange_Revenue'),
                type: "post",
                data: {from_date:from_date, to_date:to_date,week:week,month:month,_token:_token},
                success: function (data) {
                    $('#revenue').html('$'+data);
                }
            });
            // average price
            $.ajax({
                url: route('dateRange_Average_price'),
                type: "post",
                data: {from_date:from_date, to_date:to_date,week:week,month:month,_token:_token},
                success: function (data) {
                    $('#averageprice').html('$'+data);
                }
            });

            //Monthly payments
            $.ajax({
                url: route('dateRange_Monthly_payments'),
                type: "post",
                data: {from_date:from_date, to_date:to_date,week:week,month:month,_token:_token},
                success: function (data) {
                 $('#paymenttotal').html('$' +data);
                }
            });

            // latest transaction
            var table = $('#payments').DataTable({
                serverSide: true,
                processing: true,
                // ajax: "{{ route('dateRange_Latest_transactioN')}}",
                "ajax": {
                    "url": "{{ route('dateRange_Latest_transactioN')}}",
                    "type": "post",
                    "data": {
                        from_date:from_date, to_date:to_date,week:week,month:month,_token:_token
                    },
                },
                aaSorting:[[0,"asc"]],
                columns: [
                    {data: 'id', name: 'id'},
                    {data: 'item_name', name: 'item_name'},
                    {data: 'created_at', name: 'created_at'},
                    {data: 'price', name: 'price'},
                    {data: 'payment_gateway', name: 'payment_gateway'},
                    {data: 'comment', name: 'comment'},
                    {data: 'status', name: 'status'},
                ],
                'createdRow': function(row, data) {
                    $(row).attr('id', data.id)
                },
                "bDestroy": true
            });

            // Total category sales
            var table = $('#category-sales').DataTable({
                serverSide: true,
                processing: true,
                // ajax: "{{ route('dateRange_Latest_transactioN')}}",
                "ajax": {
                    "url": "{{ route('total_category_sales_Apidata')}}",
                    "type": "post",
                    "data": {
                        from_date:from_date, to_date:to_date,week:week,month:month,_token:_token
                    },
                },
                aaSorting:[[0,"asc"]],
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'sales', name: 'sales'},

                ],
                'createdRow': function(row, data) {
                    $(row).attr('id', data.id)
                },
                "bDestroy": true
            });


         // sales charts

         $.ajax({
                    url: route('dateRange_SalesChart_Apidata'),
                    type: "post",
                    data: {from_date:from_date, to_date:to_date, week:week, month:month, _token:_token},
                    success: function (data) {
                      salesChart(data);

                    }
                });

         // RadialBar Chart For Target Achieved

                  // var options = {
                  //   series: [67],
                  //   chart: {
                  //   height: 198,
                  //   type: 'radialBar',
                  //   offsetY: -10
                  // },
                  // plotOptions: {
                  //   radialBar: {
                  //     startAngle: -135,
                  //     endAngle: 135,
                  //     dataLabels: {
                  //       name: {
                  //         fontSize: '14px',
                  //         color: undefined,
                  //         offsetY: 60
                  //       },
                  //       value: {
                  //         offsetY: 22,
                  //         fontSize: '18px',
                  //         color: undefined,
                  //         formatter: function (val) {
                  //           return val + "%";
                  //         }
                  //       }
                  //     }
                  //   }
                  // },
                  // fill: {
                  //   type: 'gradient',
                  //   gradient: {
                  //       shade: 'dark',
                  //       shadeIntensity: 0.15,
                  //       inverseColors: false,
                  //       opacityFrom: 1,
                  //       opacityTo: 1,
                  //       stops: [0, 50, 65, 91]
                  //   },
                  // },
                  // stroke: {
                  //   dashArray: 4
                  // },
                  // labels: ['Series A'],
                  // };

                  // var chart = new ApexCharts(document.querySelector("#radialBar-chart"), options);
                  // chart.render();

        }

        $('#filter').click(function() {
            var from_date = $('#from_date').val();
            var to_date = $('#to_date').val();
            if(from_date != '' && to_date != '') {
                fetch_data(from_date, to_date);
            }
            else {
                alert('Both Date is required');
            }
        });
        
        $('#week').click(function() {
            $('.date-range').hide();
            var week = "current_week";
            fetch_data(from_date='', to_date='', week);
        });

        $('#month').click(function() {
            $('.date-range').hide();
            var month = "current_month";
            fetch_data(from_date='', to_date='', week='', month);
        });

        $('#refresh').click(function()
        {
          $('#from_date').val('');
          $('#to_date').val('');
          fetch_data();
          $('.date-range').hide();
        });

    // });

       $('#btn-custom').click(function() {
          $('.date-range').toggle();
        });

</script>
@endpush
