@if(empty($selected))
    {{$selected=""}}
@endif

<option value="">--Selecione--</option>
<option value="AC" @if($selected=="AC") selected @endif>AC - Acre</option>
<option value="AL" @if($selected=="AL") selected @endif>AL - Alagoas</option>
<option value="AP" @if($selected=="AP") selected @endif>AP - Amapá</option>
<option value="AM" @if($selected=="AM") selected @endif>AM - Amazonas</option>
<option value="BA" @if($selected=="BA") selected @endif>BA - Bahia</option>
<option value="CE" @if($selected=="CE") selected @endif>CE - Ceará</option>
<option value="DF" @if($selected=="DF") selected @endif>DF - Distrito Federal</option>
<option value="ES" @if($selected=="ES") selected @endif>ES - Espírito Santo</option>
<option value="GO" @if($selected=="GO") selected @endif>GO - Goiás</option>
<option value="MA" @if($selected=="MA") selected @endif>MA - Maranhão</option>
<option value="MT" @if($selected=="MT") selected @endif>MT - Mato Grosso</option>
<option value="MS" @if($selected=="MS") selected @endif>MS - Mato Grosso do Sul</option>
<option value="MG" @if($selected=="MG") selected @endif>MG - Minas Gerais</option>
<option value="PA" @if($selected=="PA") selected @endif>PA - Pará</option>
<option value="PB" @if($selected=="PB") selected @endif>PB - Paraíba</option>
<option value="PR" @if($selected=="PR") selected @endif>PR - Paraná</option>
<option value="PE" @if($selected=="PE") selected @endif>PE - Pernambuco</option>
<option value="PI" @if($selected=="PI") selected @endif>PI - Piauí</option>
<option value="RJ" @if($selected=="RJ") selected @endif>RJ - Rio de Janeiro</option>
<option value="RN" @if($selected=="RN") selected @endif>RN - Rio Grande do Norte</option>
<option value="RS" @if($selected=="RS") selected @endif>RS - Rio Grande do Sul</option>
<option value="RO" @if($selected=="RO") selected @endif>RO - Rondônia</option>
<option value="RR" @if($selected=="RR") selected @endif>RR - Roraima</option>
<option value="SC" @if($selected=="SC") selected @endif>SC - Santa Catarina</option>
<option value="SP" @if($selected=="SP") selected @endif>SP - São Paulo</option>
<option value="SE" @if($selected=="SE") selected @endif>SE - Sergipe</option>
<option value="TO" @if($selected=="TO") selected @endif>TO - Tocantins</option>
<option value="Ex" @if($selected=="Ex") selected @endif>Ex - Exterior/Outro País</option>
