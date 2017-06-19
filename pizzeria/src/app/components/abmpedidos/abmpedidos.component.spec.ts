import { async, ComponentFixture, TestBed } from '@angular/core/testing';

import { AbmpedidosComponent } from './abmpedidos.component';

describe('AbmpedidosComponent', () => {
  let component: AbmpedidosComponent;
  let fixture: ComponentFixture<AbmpedidosComponent>;

  beforeEach(async(() => {
    TestBed.configureTestingModule({
      declarations: [ AbmpedidosComponent ]
    })
    .compileComponents();
  }));

  beforeEach(() => {
    fixture = TestBed.createComponent(AbmpedidosComponent);
    component = fixture.componentInstance;
    fixture.detectChanges();
  });

  it('should create', () => {
    expect(component).toBeTruthy();
  });
});
