@extends('layouts.master')
@section('title')
    Server Details
@endsection
@section('content')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-center">
                <h2>SERVER DETAILS</h2>
                <small class="text-muted">Below you find all important data (e.g. access data) of the selected contract.</small>
                <hr>
                 <table class="table">
            </div>
            <table class="table broder">
                <thead class="thead-dark">
                  <tr>
                    <th scope="col"><small>Coffee lake HDD XL</small></th>
                    <th scope="col"></th>
                  </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><small>Server name</small></td>
                        <td><small>USA</small></td>
                    </tr>
                    <tr>
                        <td><small>Datacenter</small></td>
                        <td><small>BOBO s2 Fully Managed Server</small></td>
                    </tr>
                    <tr>
                        <td><small>Contract number</small></td>
                        <td><small>---</small></td>
                    </tr>
                    <tr>
                        <td><small>Activation date	</small></td>
                        <td><small>6-6-22</small></td>
                    </tr>
                    <tr>
                        <td><small>Contract length</small></td>
                        <td><small>1 Year</small></td>
                    </tr>
                </tbody>
              </table>
     

            <table class="table broder">
                <thead class="thead-dark">
                    <tr>
                    <th scope="col"><small>Components</small></th>
                    <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><small>HDD</small></td>
                        <td><small>4 TB SATA 3.5" 7,200 rpm
                        </small></td>
                    </tr>
                    <tr>
                        <td><small>HDD</small></td>
                        <td><small>4 TB SATA 3.5" 7,200 rpm
                        </small></td>
                    </tr>
                    <tr>
                        <td><small>RAM</small></td>
                        <td><small>16 GB</small></td>
                    </tr>
                    <tr>
                        <td><small>RAM</small></td>
                        <td><small>16 GB</small></td>
                    </tr>
                    <tr>
                        <td><small>RAM</small></td>
                        <td><small>16 GB</small></td>
                    </tr>
                    <tr>
                        <td><small>CPU</small></td>
                        <td><small>Intel Core i7 9700</small></td>
                    </tr>
                </tbody>
            </table>

            <table class="table broder">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"><small>SSH login</small></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><small>User name</small></td>
                        <td><small>root</small></td>
                    </tr>
                    <tr>
                        <td><small>Password</small></td>
                        <td><small>1811Geen!</small></td>
                    </tr>
                   
                </tbody>
            </table>

            <table class="table broder">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col"><small>Control panel</small></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><small>Version</small></td>
                        <td><small>Plesk reloaded </small></td>
                    </tr>
                    <tr>
                        <td><small>URL</small></td>
                        <td><small>	https://astra7057.startdedicated.net:8443</small></td>
                    </tr>
                    <tr>
                        <td><small>Login name	</small></td>
                        <td><small>admin </small></td>
                    </tr>
                    <tr>
                        <td><small>Password</small></td>
                        <td><small>1811Geen!</small></td>
                    </tr>
                   
                </tbody>
            </table>

        </div>
    </div>
@endsection
