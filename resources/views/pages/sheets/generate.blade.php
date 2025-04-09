<!doctype html>
<html lang='en'>
    <head>
        <meta charset='UTF-8'/>
        <title>Document</title>
        <link href='{{public_path('style.css')}}' rel='stylesheet'/>
    </head>
    <body>
        @for($i = 0; $i < $sheets->count(); $i++)
            @if($i == 0)
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h2 class='sheet-title'>Logo de Empresa</h2>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-2'>Corte</td>
                        <td class='sheet-value-2'>{{$today}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>DUI</td>
                        <td class='sheet-value-2'>{{$sheets[$i]->dui}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>Empleado</td>
                        <td class='sheet-value-2'>
                            {{$sheets[$i]->first_name}}
                            {{$sheets[$i]->second_name}}
                            {{$sheets[$i]->first_lastname}}
                            {{$sheets[$i]->second_lastname}}
                        </td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Salario Base</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->salary, 2)}}</td>
                        <td class='sheet-label-4'>Salario Total</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_employee_total, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Horas Extras Diurnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_day_hour, 2)}}</td>
                        <td class='sheet-label-4'>Vacaciones</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_vacation, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Extras Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_night_hour, 2)}}</td>
                        <td class='sheet-label-4'>Aguinaldo</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_aguinald, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_night_hour, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>
                
                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>AFP</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_afp, 2)}}</td>
                        <td class='sheet-label-4'>ISSS</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_isss, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Bonos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->bonuses, 2)}}</td>
                        <td class='sheet-label-4'>Descuentos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->no_bonuses, 2)}}</td>
                    </tr>
                </table>

                <table style='width: 100%; padding-top: 20px; padding-bottom: 100px;'>
                    <tr>
                        <td class='sheet-label-4'>Firma Empleador</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                        <td class='sheet-label-4'>Firma Empleado</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                    </tr>
                </table>
            @elseif($i % 2 == 0)
                <div class='page-break'></div>
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h2 class='sheet-title'>Logo de Empresa</h2>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-2'>Corte</td>
                        <td class='sheet-value-2'>{{$today}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>DUI</td>
                        <td class='sheet-value-2'>{{$sheets[$i]->dui}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>Empleado</td>
                        <td class='sheet-value-2'>
                            {{$sheets[$i]->first_name}}
                            {{$sheets[$i]->second_name}}
                            {{$sheets[$i]->first_lastname}}
                            {{$sheets[$i]->second_lastname}}
                        </td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Salario Base</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->salary, 2)}}</td>
                        <td class='sheet-label-4'>Salario Total</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_employee_total, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Horas Extras Diurnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_day_hour, 2)}}</td>
                        <td class='sheet-label-4'>Vacaciones</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_vacation, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Extras Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_night_hour, 2)}}</td>
                        <td class='sheet-label-4'>Aguinaldo</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_aguinald, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_night_hour, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>
                
                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>AFP</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_afp, 2)}}</td>
                        <td class='sheet-label-4'>ISSS</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_isss, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Bonos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->bonuses, 2)}}</td>
                        <td class='sheet-label-4'>Descuentos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->no_bonuses, 2)}}</td>
                    </tr>
                </table>

                <table style='width: 100%; padding-top: 20px; padding-bottom: 100px;'>
                    <tr>
                        <td class='sheet-label-4'>Firma Empleador</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                        <td class='sheet-label-4'>Firma Empleado</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                    </tr>
                </table>
            @else
                <table>
                    <tbody>
                        <tr>
                            <td>
                                <h2 class='sheet-title'>Logo de Empresa</h2>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-2'>Corte</td>
                        <td class='sheet-value-2'>{{$today}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>DUI</td>
                        <td class='sheet-value-2'>{{$sheets[$i]->dui}}</td>
                    </tr>
                    <tr>
                        <td class='sheet-label-2'>Empleado</td>
                        <td class='sheet-value-2'>
                            {{$sheets[$i]->first_name}}
                            {{$sheets[$i]->second_name}}
                            {{$sheets[$i]->first_lastname}}
                            {{$sheets[$i]->second_lastname}}
                        </td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Salario Base</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->salary, 2)}}</td>
                        <td class='sheet-label-4'>Salario Total</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_employee_total, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Horas Extras Diurnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_day_hour, 2)}}</td>
                        <td class='sheet-label-4'>Vacaciones</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_vacation, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Extras Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_extra_night_hour, 2)}}</td>
                        <td class='sheet-label-4'>Aguinaldo</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_aguinald, 2)}}</td>
                    </tr>

                    <tr>
                        <td class='sheet-label-4'>Horas Nocturnas</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_night_hour, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                <div class='sheet-divisor'></div>
                
                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>AFP</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_afp, 2)}}</td>
                        <td class='sheet-label-4'>ISSS</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->v_emp_isss, 2)}}</td>
                    </tr>
                </table>

                <div class='sheet-divisor'></div>
                

                <table style='width: 100%;'>
                    <tr>
                        <td class='sheet-label-4'>Bonos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->bonuses, 2)}}</td>
                        <td class='sheet-label-4'>Descuentos</td>
                        <td class='sheet-value-4'>${{number_format($sheets[$i]->no_bonuses, 2)}}</td>
                    </tr>
                </table>

                <table style='width: 100%; padding-top: 20px;'>
                    <tr>
                        <td class='sheet-label-4'>Firma Empleador</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                        <td class='sheet-label-4'>Firma Empleado</td>
                        <td class='sheet-value-4' style='border-bottom: 1px solid silver;'></td>
                    </tr>
                </table>
            @endif
        @endfor
    </body>
</html>
