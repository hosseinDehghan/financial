<h1>Financial</h1>
<hr>
<h3>stocks</h3>
<hr>
<form action="@if(session("stock")){{url("financial/updateStock")}}/{{session("stock")->id}}@else {{url("financial/createStock")}} @endif" method="post">
    {{csrf_field()}}
    <input type="text" name="stock" value="@if(session("stock")){{session("stock")->stock}}@endif" placeholder="Enter Stock for this month of year">
    <br><br>
    <?php $month=["فروردین","اردیبهشت","خرداد","تیر","مرداد","شهریور","مهر","آبان",
        "آذر","دی","بهمن","اسفند"];?>
    <select name="month">
        <?php
        foreach($month as $key=>$value){?>
            <option value="<?php echo $key+1; ?>"
            @if(session("stock")){{(session("stock")->month==$key+1)?"selected":""}}@endif><?php echo $value; ?></option>
        <?php }?>
    </select>
    <select name="year">
        <?php
        for ($year=1398;$year<1418;$year++){
        ?>
        <option value="<?php echo $year; ?>"
         @if(session("stock")){{(session("stock")->year==$year)?"selected":""}}@endif><?php echo $year; ?></option>
        <?php } ?>
    </select>
    <br><br>
    <input type="submit" name="register" value="register">
</form>
<table border="1">
    <tr><th>id</th><th>stock</th><th>month</th><th>year</th><th>edit</th><th>del</th></tr>
    @if(isset($stocks))
        @foreach($stocks as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->stock}}</td>
                <td>{{$item->month}}</td>
                <td>{{$item->year}}</td>
                <td><a href="{{url("financial/editStock")}}/{{$item->id}}">edit</a></td>
                <td><a href="{{url("financial/deleteStock")}}/{{$item->id}}">delete</a></td>
            </tr>
        @endforeach
    @endif
</table>
<hr>
<h3>cash</h3>
<hr>
<form action="{{url("financial/createCash")}}" method="post">
    {{csrf_field()}}
    <textarea cols="35" rows="8" name="details" placeholder="Enter details"
    >@if(session("cash")){{session("cash")->details}}@endif</textarea>
    <br><br>
    <input type="text" name="amount" placeholder="Enter amount"
    value="@if(session("cash")){{session("cash")->amount}}@endif">
    <br><br>
    <select name="year" id="cashYear">
        <?php
            if(session("cash"))
                $stockItem=getStocks(session("cash")->stocks);
        for ($year=1398;$year<1418;$year++){
        ?>
        <option value="<?php echo $year; ?>"
        @if(isset($stockItem)){{($stockItem->year==$year)?"selected='selected'":""}}@endif><?php echo $year; ?></option>
        <?php } ?>
    </select>
    <select name="stock" id="cashMonth">
        <option value="1">1398-فروردین-1500000</option>
        <option value="1">1398-اردیبهشت-1600000</option>
        <option value="1">1398-خرداد-1700000</option>
        <option value="1">1398-تیر-1800000</option>
        <option value="1">1398-مرداد-1850000</option>
        <option value="1">1398-شهریور-1900000</option>
        <option value="1">1398-مهر-1930000</option>
        <option value="1">1398-آبان-1950000</option>
        <option value="1">1398-آذر-1970000</option>
        <option value="1">1398-دی-1980000</option>
        <option value="1">1398-بهمن-1900000</option>
        <option value="1">1398-اسفند-2000000</option>
    </select>
    <br><br>
    debtor <input type="radio" name="debtorOrCreditor" value="2"
    @if(session("cash")){{(session("cash")->debtorOrCreditor==2)?"checked='checked'":""}}@endif>
    <br>
    creditor <input type="radio" name="debtorOrCreditor" value="1"
    @if(session("cash")){{(session("cash")->debtorOrCreditor==1)?"checked='checked'":""}}@endif>
    <br>
    anyone <input type="radio" name="debtorOrCreditor" value="0"
    @if(session("cash")){{(session("cash")->debtorOrCreditor==0)?"checked='checked'":""}}@endif>
    <br><br>
    receive <input type="radio" name="receiveOrPay" value="0"
    @if(session("cash")){{(session("cash")->receiveOrPay==0)?"checked='checked'":""}}@endif>
    <br>
    pay <input type="radio" name="receiveOrPay" value="1"
    @if(session("cash")){{(session("cash")->receiveOrPay==1)?"checked='checked'":""}}@endif>
    <br><br>
    <select name="day">
        <?php
        for ($day=1;$day<32;$day++){
        ?>
        <option value="<?php echo $day; ?>"
        @if(session("cash")){{(session("cash")->day==$day)?"checked='checked'":""}}@endif><?php echo $day; ?></option>
        <?php } ?>
    </select>
    <br><br>
    <input type="submit" name="register" value="register">
</form>
<hr>
<h4>total receive : {{totalReceive()}}</h4>
<h4>total Pay : {{totalPay()}}</h4>
<table border="1">
    <tr><th>id</th><th>details</th><th>amount</th><th>stock</th><th>year</th><th>month</th><th>day</th><th>debtorOrCreditor</th><th>receiveOrPay</th><th>edit</th><th>del</th></tr>
    @if(isset($cash))
        @foreach($cash as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->details}}</td>
                <td>{{$item->amount}}</td>
                <td>{{getStocks($item->stocks)->stock}}</td>
                <td>{{getStocks($item->stocks)->year}}</td>
                <td>{{getStocks($item->stocks)->month}}</td>
                <td>{{$item->day}}</td>
                <td>{{($item->debtorOrCreditor==0)?"-":($item->debtorOrCreditor==1?"debort":"creditor")}}</td>
                <td>{{($item->receiveOrPay==0)?"receive":"Pay"}}</td>
                <td><a href="{{url("financial/editCash")}}/{{$item->id}}">edit</a></td>
                <td><a href="{{url("financial/deleteCash")}}/{{$item->id}}">delete</a></td>
            </tr>
        @endforeach
    @endif
</table>
<?php
        function getStocks($id){
            $stock=\Hosein\Financial\Stock::where("id",$id)->first();
            return $stock;
        }
        function totalReceive(){
            $cash=\Hosein\Financial\cash::where("receiveOrPay",0)->get();
            $sum=0;
            foreach ($cash as $item){
                    $sum+=$item->amount;
            }
            return $sum;
        }
        function totalPay(){
            $cash=\Hosein\Financial\cash::where("receiveOrPay",1)->get();
            $sum=0;
            foreach ($cash as $item){
                $sum+=$item->amount;
            }
            return $sum;
        }
?>
<script
        src="https://code.jquery.com/jquery-3.4.1.min.js"
        integrity="sha256-CSXorXvZcTkaix6Yvo6HppcZGetbYMGWSFlBw8HfCJo="
        crossorigin="anonymous"></script>
<script>
    $(document).ready(function () {
        sendData(parseInt("{{(session("cash"))?$stockItem->year:1398}}"));
        $("#cashYear").change(function () {
            sendData($(this).val());
        });
    });
    function sendData($year) {
        $.ajax({
            "url":"{{url("financial/stock/getWithYear")}}/"+$year,
            "method":"get",
            beforeSend:function () {

            },
            success:function (data) {
                data=JSON.parse(data);
                str="";
                for(i=0;i<data.length;i++){
                    str+="<option value='"+data[i].id+"'";

                    if(data[i].id==parseInt("{{(session("cash")?session("cash")->stocks:"")}}")){
                        str+="selected='selected'";
                    }
                    str+=">"+data[i].year+
                        "-"+data[i].month+"-"+data[i].stock+"</option>";
                }
                $("#cashMonth").html(str);
            }
        })
    }
</script>